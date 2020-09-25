<?php
/*
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
declare(strict_types=1);

namespace Google\Generator\Ast;

use Google\Generator\Collections\Vector;
use Google\Generator\Utils\ResolvedType;
use Google\Generator\Utils\Type;

/** Base of the PHP code AST. */
abstract class AST
{
    /** @var string Constant to reference `$this`. */
    public const THIS = "\0\$this";

    /** @var string Constant to reference `self`. */
    public const SELF = "\0self";

    /** @var string Constant to reference `null`. */
    public const NULL = "\0null";

    /** @var string Constant to reference `__DIR__` */
    public const __DIR__ = "\0__DIR__";

    protected static function deref($obj): string
    {
        // TODO: Handle $obj being a type.
        return $obj === static::SELF ? '::' : '->';
    }

    protected static function toPhp($x): string
    {
        if (is_string($x)) {
            if (strncmp($x, "\0", 1) === 0) {
                // \0 prefix means the string that follows is used verbatim.
                return substr($x, 1);
            } else {
                // Otherwise strings are treated as string literals.
                return "'{$x}'";
            }
        } elseif (is_numeric($x)) {
            return strval($x);
        } elseif ($x instanceof PhpClassMember) {
            return $x->getName();
        } elseif ($x instanceof AST) {
            return $x->toCode();
        } elseif ($x instanceof ResolvedType) {
            return $x->toCode();
        } else {
            throw new \Exception('Cannot convert to PHP code.');
        }
    }

    protected function clone(Callable $fnOnClone)
    {
        $clone = clone $this;
        $fnOnClone($clone);
        return $clone;
    }

    /**
     * Create a PHP file.
     *
     * @param PhpClass $class The class to be contained within this file.
     *
     * @return PhpFile
     */
    public static function file(PhpClass $class): PhpFile
    {
        return new PhpFile($class);
    }

    /**
     * Create a class.
     *
     * @param Type $type The type of the class to create.
     *
     * @return PhpClass
     */
    public static function class(Type $type): PhpClass
    {
        return new PhpClass($type);
    }

    /**
     * Create a class constant.
     *
     * @param string $name The name of the constant.
     *
     * @return PhpConstant
     */
    public static function constant(string $name): PhpConstant
    {
        return new PhpConstant($name);
    }

    /**
     * Create a class property.
     *
     * @param string $name The name of the property.
     *
     * @return PhpProperty
     */
    public static function property(string $name): PhpProperty
    {
        return new PhpProperty($name);
    }

    /**
     * Create a class method.
     *
     * @param string $name The name of the method.
     *
     * @return PhpMethod
     */
    public static function method(string $name): PhpMethod
    {
        return new PhpMethod($name);
    }

    /**
     * Create a block of PHP code.
     *
     * @param array $code The code to include in this block.
     *     Each item must be an AST instance or a Vector thereof.
     *     Null values will be ignored.
     *
     * @return AST
     */
    public static function block(...$code): AST
    {
        $code = Vector::new($code)
            ->flatten()
            ->filter(fn($x) => !is_null($x));
        return new class($code) extends AST {
            public function __construct($code)
            {
                $this->code = $code;
            }
            public function toCode(): string
            {
                return $this->code
                    ->map(fn($x) => $x->toCode() . ';')
                    ->join();
            }
        };
    }

    /**
     * Create a PHP variable.
     *
     * @param string $name The name of the variable, without leading '$'.
     * @param ?ResolvedType $type Optional. The type of this variable.
     *
     * @return Expression
     */
    public static function var(string $name, ?ResolvedType $type = null): Expression
    {
        return new class($name, $type) extends Expression {
            public function __construct($name, $type)
            {
                $this->name = $name;
                $this->type = $type;
            }
            public function toCode(): string
            {
                $type = is_null($this->type) ? '' : static::toPhp($this->type) . ' ';
                return $type . '$' . $this->name;
            }
        };
    }

    /**
     * Create a 'return' statement, returning the specified expression.
     *
     * @param Expression $expr Expression to return.
     *
     * @return AST
     */
    public static function return(Expression $expr): AST
    {
        return new class($expr) extends AST {
            public function __construct($expr)
            {
                $this->expr = $expr;
            }
            public function toCode(): string
            {
                return 'return ' . static::toPhp($this->expr);
            }
        };
    }

    /**
     * Create an array initializer expression.
     *
     * @param array $array The array content. Supports both associative and sequential arrays.
     *
     * @return Expression
     */
    public static function array(array $array): Expression
    {
        $keyValues = Vector::new(array_map(fn($v, $k) => [$k, $v], $array, array_keys($array)))
            ->filter(fn($x) => !is_null($x[1]));
        return new class($keyValues) extends Expression {
            public function __construct($keyValues)
            {
                $this->keyValues = $keyValues;
            }
            public function toCode(): string
            {
                $isAssocArray = $this->keyValues->map(fn($x) => $x[0])->toArray() !== range(0, count($this->keyValues) - 1);
                $items = $isAssocArray ?
                    $this->keyValues->map(fn($x) => static::toPhp($x[0]) . ' => ' . static::toPhp($x[1])) :
                    $this->keyValues->map(fn($x) => static::toPhp($x[1]));
                $items = $items->map(fn($x) => "{$x},\n")->join();
                return "[\n{$items}]";
            }
        };
    }

    /**
     * Create an expression to access a class property or const.
     *
     * @param mixed $obj The object containing the accessee.
     * @param mixed $accessee The property or const being accessed.
     *
     * @return Expression
     */
    public static function access($obj, $accessee): Expression
    {
        return new class($obj, $accessee) extends Expression {
            public function __construct($obj, $accessee)
            {
                $this->obj = $obj;
                $this->accessee = $accessee;
            }
            public function toCode(): string
            {
                return static::toPhp($this->obj) . static::deref($this->obj) . static::toPhp($this->accessee);
            }
        };
    }

    /**
     * Create an expression to call a method. This method returns a Callable into which the args are passed.
     *
     * @param mixed $obj The object containing the method to call.
     * @param mixed $callee The method to call.
     *
     * @return Callable The returned Callable returns an Expression once called with callee args.
     */
    public static function call($obj, $callee): Callable
    {
        return fn(...$args) => new class($obj, $callee, Vector::new($args)) extends Expression {
            public function __construct($obj, $callee, $args)
            {
                $this->obj = $obj;
                $this->callee = $callee;
                $this->args = $args;
            }
            public function toCode(): string
            {
                $args = $this->args->map(fn($x) => static::toPhp($x))->join(', ');
                return static::toPhp($this->obj) . static::deref($this->obj) . static::toPhp($this->callee) . "({$args})";
            }
        };
    }

    /**
     * Create a string concat expression.
     *
     * @param array $items The items to concat.
     *
     * @return Expression
     */
    public static function concat(...$items): ?Expression
    {
        $items = Vector::New($items);
        $null = $items->any(fn($x) => is_null($x));
        return $null ? null : new class($items) extends Expression
        {
            public function __construct($items)
            {
                $this->items = $items;
            }
            public function toCode(): string
            {
                return $this->items->map(fn($x) => static::toPhp($x))->join(' . ');
            }
        };
    }

    /**
     * Convert this AST to lines of text suitable for directlyincluding in the output PHP file.
     * The returned string will be mostly unformatted, so an extra formatting step will be required.
     *
     * @return string
     */
    public abstract function toCode(): string;
}
