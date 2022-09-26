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

use Google\Generator\Collections\Set;
use Google\Generator\Collections\Vector;

final class PhpFile extends AST
{
    public function __construct(PhpClass $class = null)
    {
        $this->class = $class;
        $this->uses = Set::new();
        $this->headerLines = Vector::new();
    }

    private AST $block;
    private Set $uses;
    private Vector $headerLines;

    public function withUses(Set $uses)
    {
        return $this->clone(fn ($clone) => $clone->uses = $uses);
    }

    public function withApacheLicense(int $year)
    {
        $license = <<<EOF
            /*
             * Copyright {$year} Google LLC
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

            EOF;
        $license = Vector::new(explode("\n", $license));
        return $this->clone(fn ($clone) => $clone->headerLines = $clone->headerLines->concat($license));
    }

    public function withGeneratedCodeWarning()
    {
        $warning = <<<'EOF'
            /*
             * GENERATED CODE WARNING
             * This file was automatically generated - do not edit!
             */

            EOF;
        $warning = Vector::new(explode("\n", $warning));
        return $this->clone(fn ($clone) => $clone->headerLines = $clone->headerLines->concat($warning));
    }

    public function withGeneratedFromProtoCodeWarning(string $filePath, bool $isGa)
    {
        $warning = <<<EOF
            /*
             * GENERATED CODE WARNING
             * Generated by gapic-generator-php from the file
             * https://github.com/googleapis/googleapis/blob/master/{$filePath}
             * Updates to the above are reflected here through a refresh process.
            EOF;
        if ($isGa === false) {
            $warning .= "\n *\n * @experimental";
        }
        $warning .= "\n */";
        $warning = Vector::new(explode("\n", $warning));
        return $this->clone(fn ($clone) => $clone->headerLines = $clone->headerLines->concat($warning));
    }

    public function withBlock($block)
    {
        return $this->clone(fn ($clone) => $clone->block = $block);
    }

    public function toCode(): string
    {
        $lines = [
            "<?php",
            $this->headerLines->map(fn ($x) => "{$x}\n")->join(),
            // TODO(miraleung): Uncomment this when the client libraries support only PHP 7+.
            // "declare(strict_types=1);\n",
        ];

        if ($this->class) {
            $lines[] = "namespace {$this->class->type->getNamespace()};\n";
            $lines[] = $this->uses->toVector()->map(fn ($x) => "use {$x};")->join();
        }

        return implode("\n", $lines) .
            (count($this->uses) >= 1 ? "\n" : '') .
            static::toPhp($this->class ?: $this->block);
    }
}
