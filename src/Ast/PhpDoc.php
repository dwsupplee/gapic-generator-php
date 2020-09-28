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

use Google\Generator\Collections\Map;
use Google\Generator\Collections\Vector;
use Google\Generator\Utils\Formatter;
use Google\Generator\Utils\ResolvedType;

abstract class PhpDoc
{
    /**
     * Create a PHP Documentation block.
     * Items passed in make up the content of the block.
     *
     * @param array $items The block contents.
     *
     * @return PhpDoc
     */
    public static function block(...$items): PhpDoc
    {
        return new class(Vector::new($items)->flatten()->filter(fn($x) => !is_null($x))) extends PhpDoc
        {
            public function __construct($items)
            {
                $this->items = $items;
                $this->isBlock = true;
            }
            protected function toLines(Map $info): Vector
            {
                $info = Map::new();
                foreach ($this->items as $item)
                {
                    $info = $item->preProcess($info);
                }
                return Vector::zip($this->items, $this->items->skip(1)->append(null))->flatMap(function($x) use($info) {
                    [$item, $next] = $x;
                    $result = $item->toLines($info);
                    if (!is_null($next) && !(isset($item->isParam) && isset($next->isParam))) {
                        $result = $result->append('');
                    }
                    return $result;
                });
            }
        };
    }

    /**
     * Create a new-line within the PHP doc content.
     *
     * @return PhpDoc
     */
    public static function newLine(): PhpDoc
    {
        return new class extends PhpDoc
        {
            protected function toLines(Map $info): Vector
            {
                return Vector::new();
            }
        };
    }

    /**
     * Create zero or more lines of pre-formatted text within a PHP doc block.
     * The lines specified are added to the PHP doc with no extra processing.
     *
     * @param Vector $lines Vector of string; the lines of content.
     *
     * @return PhpDoc
     */
    public static function preFormattedText(Vector $lines): PhpDoc
    {
        return new class($lines) extends PhpDoc
        {
            public function __construct($lines)
            {
                $this->lines = $lines;
            }
            protected function toLines(Map $info): Vector
            {
                return $this->lines;
            }
        };
    }

    /**
     * Add unformatted text to the PHP doc block.
     * The parts specified may be a variety of types, which are processed according to type.
     * Output is formatted to fit within a fixed line length (of 80).
     *
     * @param array $parts The doc parts
     *
     * @return PhpDoc
     */
    public static function text(...$parts): PhpDoc
    {
        return new class(Vector::new($parts)) extends PhpDoc
        {
            public function __construct($parts)
            {
                $this->parts = $parts;
            }
            protected function toLines(Map $info): Vector
            {
                $lineLen = 80;
                $lines = Vector::new();
                $line = '';

                $commitLine = function() use(&$lines, &$line) {
                    if ($line !== '') {
                        $lines = $lines->append($line);
                        $line = '';
                    }
                };
                $add = function($s) use(&$lines, &$line, $lineLen, $commitLine) {
                    if (strlen($line) + 1 + strlen($s) > $lineLen && $line !== '') {
                        $commitLine();
                    }
                    if ($line === '') {
                        $line = $s;
                    } else {
                        $line .= ' ' . $s;
                    }
                };

                foreach ($this->parts as $part) {
                    // TODO: Add further type-specific processing as required.
                    if (is_string($part)) {
                        $words = explode(' ', $part);
                        foreach ($words as $word) {
                            if ($word !== '') {
                                $add($word);
                            }
                        }
                    } elseif ($part instanceof PhpDoc) {
                        $commitLine();
                        foreach ($part->toLines(Map::new()) as $line) {
                            $commitLine();
                        }
                    } elseif ($part instanceof ResolvedType) {
                        $word = '{@see ' . $part->toCode() . '}';
                        $add($word);
                    } elseif ($part instanceof AST) {
                        $word = '{@see ' . $part->ToCode() . '}';
                        $add($word);
                    } else {
                        throw new \Exception('Cannot convert part to text');
                    }
                }
                $commitLine();
                return $lines;
            }
        };
    }

    /**
     * Add the @experimental tag to the PHP doc block.
     *
     * @return PhpDoc
     */
    public static function experimental(): PhpDoc
    {
        return new class extends PhpDoc {
            protected function toLines(Map $info): Vector
            {
                return Vector::new(['@experimental']);
            }
        };
    }

    /**
     * Add a @throw tag to the PHP doc block.
     *
     * @param ResolvedType $type The exception type thrown.
     *
     * @return PhpDoc
     */
    public static function throws(ResolvedType $type): PhpDoc
    {
        return new class($type) extends PhpDoc {
            public function __construct($type)
            {
                $this->type = $type;
            }
            protected function toLines(Map $info): Vector
            {
                return Vector::new(["@throws {$this->type->toCode()}"]);
            }
        };
    }

    private static function paramOrType(string $tag, Vector $types, $varOrName, ?PhpDoc $doc): PhpDoc
    {
        return new class($tag, $types, $varOrName, $doc) extends PhpDoc {
            private const K_TYPE = 'param_type';
            private const K_NAME = 'param_name';
            public function __construct($tag, $types, $varOrName, $doc)
            {
                $this->tag = $tag;
                $this->types = $types;
                $this->varOrName = $varOrName;
                $this->doc = $doc;
                $this->isParam = true;
            }
            protected function preProcess(Map $info): Map
            {
                // This may be called multiple times.
                $this->typesJoined = $this->types->map(fn($x) => $x->toCode())->join('|');
                $this->name = $this->varOrName instanceof AST ? $this->varOrName->toCode() : '$' . $this->varOrName;
                if ($this->tag === 'param') {
                    // Parameters align the param name and the description, so get max lengths.
                    $info = $info->set(static::K_TYPE, max($info->get(static::K_TYPE, 0), strlen($this->typesJoined)));
                    $info = $info->set(static::K_NAME, max($info->get(static::K_NAME, 0), strlen($this->name)));
                }
                return $info;
            }
            protected function toLines(Map $info): Vector
            {
                $lines = is_null($this->doc) ? Vector::new([]) : $this->doc->toLines(Map::new());
                if ($this->tag === 'param') {
                    // Align param name and descriptions.
                    $typeLen = $info->get(static::K_TYPE, 0);
                    $nameLen = $info->get(static::K_NAME, 0);
                    $types = str_pad($this->typesJoined, $typeLen);
                    $introPad = str_repeat(' ', $nameLen - strlen($this->name));
                    $intro = "@{$this->tag} {$types} {$this->name} {$introPad}";
                    if (is_null($this->doc)) {
                        return Vector::new([trim($intro)]);
                    } else {
                        if (isset($this->doc->isBlock)) {
                            return $lines
                                ->map(fn($x) => '    ' . $x)
                                ->prepend($intro . '{')
                                ->append('}');
                        } else {
                            $pad = str_repeat(' ', strlen($intro));
                            return $lines->take(1)->map(fn($x) => $intro . $x)
                                ->concat($lines->skip(1)->map(fn($x) => $pad . $x));
                        }
                    }
                } else {
                    $indent = str_repeat(' ', strlen("@{$this->tag} "));
                    return Vector::new(["@{$this->tag} {$this->typesJoined} {$this->name}"])
                        ->concat($lines->map(fn($x) => $indent . $x));
                }
            }
        };
    }

    /**
     * Add a @param tag to the PHP doc block.
     *
     * @param PhpParam $param The param to add.
     * @param PhpDoc $doc The documetation for this param.
     *
     * @return PhpDoc
     */
    public static function param(PhpParam $param, PhpDoc $doc): PhpDoc
    {
        return static::paramOrType('param', Vector::new([$param->type]), $param->var, $doc);
    }

    /**
     * Add a @type tag to the PHP doc block.
     *
     * @param Vector $type Vector of ResolvedType; the type(s) of this element.
     * @param string $name The name of this element.
     * @param PhpDoc $doc The documetation for this element.
     *
     * @return PhpDoc
     */
    public static function type(Vector $types, string $name, PhpDoc $doc): PhpDoc
    {
        return static::paramOrType('type', $types, $name, $doc);
    }

    /**
     * Add a code example to the PHP doc block.
     *
     * @param AST $ast The code example in AST form.
     * @param ?PhpDoc $intro Optional; introductory text to this code example.
     *
     * @return PhpDoc
     */
    public static function example(AST $ast, ?PhpDoc $intro = null): PhpDoc
    {
        return new class($ast, $intro) extends PhpDoc
        {
            public function __construct($ast, $intro)
            {
                $this->ast = $ast;
                $this->intro = $intro;
            }
            protected function toLines(Map $info): Vector
            {
                $code = Formatter::format("<?php\n{$this->ast->toCode()}");
                return
                    (is_null($this->intro) ? Vector::new() : $this->intro->toLines(Map::new()))
                    ->concat(
                        Vector::new(explode("\n", $code))
                            ->skip(3)->skipLast(1)
                            ->filter(fn($x) => $x !== '')
                            ->prepend('```')
                            ->append('```')
                    );
            }
        };
    }

    /** Override to provide content-specific pre-processing. This may be called multiple times. */
    protected function preProcess(Map $info): Map
    {
        return $info;
    }

    /** Override to convert this PhpDoc to lines of text. */
    protected abstract function toLines(Map $info): Vector;

    /**
     * Convert this PhpDoc block to lines of text suitable for directly
     * including in the output PHP file.
     *
     * @return string
     */
    public function toCode(): string
    {
        $lines = $this->toLines(Map::new());
        if (count($lines) <= 1) {
            return "/** {$lines->join()} */\n";
        } else {
            return
                "/**\n" .
                $lines
                    ->map(fn($x) => rtrim($x))
                    ->map(fn($x) => ' *' . (strlen($x) === 0 ? "\n" : " {$x}\n"))->join() .
                " */\n";
        }
    }
}
