<?php
/*
 * Copyright 2022 Google LLC
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

namespace Google\Generator\Generation;

use Google\ApiCore\ApiException;
use Google\ApiCore\BidiStream;
use Google\ApiCore\ClientStream;
use Google\ApiCore\OperationResponse;
use Google\ApiCore\ServerStream;
use Google\Generator\Ast\AST;
use Google\Generator\Ast\PhpDoc;
use Google\Generator\Ast\PhpFunction;
use Google\Generator\Ast\Variable;
use Google\Generator\Collections\Vector;
use Google\Generator\Utils\Helpers;
use Google\Generator\Utils\Type;
use Google\Protobuf\GPBEmpty;
use Google\Rpc\Status;

class SnippetGenerator
{
    /** @var int The license year. */
    private int $licenseYear;

    /** @var ServiceDetails The service details. */
    private ServiceDetails $serviceDetails;

    /**
     * @param int $licenseYear
     * @param ServiceDetails $serviceDetails
     */
    public function __construct(int $licenseYear, ServiceDetails $serviceDetails)
    {
        $this->licenseYear = $licenseYear;
        $this->serviceDetails = $serviceDetails;
    }

    /**
     * @param int $licenseYear
     * @param ServiceDetails $serviceDetails
     * @return array
     */
    public static function generate(int $licenseYear, ServiceDetails $serviceDetails): array
    {
        return (new SnippetGenerator($licenseYear, $serviceDetails))->generateImpl();
    }

    /**
     * @return array
     */
    private function generateImpl(): array
    {
        $files = [];

        foreach ($this->serviceDetails->methods as $method) {
            $regionTag = $this->generateRegionTag($method->name);
            $snippetDetails = new SnippetDetails($method, $this->serviceDetails);
            $rpcMethodExample = $this->rpcMethodExample($snippetDetails);
            $files[Helpers::toSnakeCase($method->name)] = AST::file(null)
                ->withApacheLicense($this->licenseYear)
                ->withGeneratedCodeWarning()
                ->withBlock(
                    AST::block(
                        AST::literal("require_once __DIR__ . '/../../../vendor/autoload.php'"),
                        PHP_EOL,
                        "// [START $regionTag]",
                        $snippetDetails
                            ->context
                            ->usesByShortName
                            ->values()
                            ->map(fn ($use) => AST::literal("use {$use}")),
                        PHP_EOL,
                        $rpcMethodExample,
                        "// [END $regionTag]"
                    )
                );
        }

        return $files;
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     * @throws \Exception
     */
    private function rpcMethodExample(SnippetDetails $snippetDetails): AST
    {
        switch ($snippetDetails->methodDetails->methodType) {
            case MethodDetails::NORMAL:
                $code = $this->rpcMethodExampleNormal($snippetDetails);
                break;
            case MethodDetails::CUSTOM_OP:
                // Fallthrough - rpcMethodExampleOperation handles custom operations as well.
            case MethodDetails::LRO:
                $code = $this->rpcMethodExampleOperation($snippetDetails);
                break;
            case MethodDetails::PAGINATED:
                $code = $this->rpcMethodExamplePaginated($snippetDetails);
                break;
            case MethodDetails::BIDI_STREAMING:
                $code = $this->rpcMethodExampleBidiStreaming($snippetDetails);
                break;
            case MethodDetails::SERVER_STREAMING:
                $code = $this->rpcMethodExampleServerStreaming($snippetDetails);
                break;
            case MethodDetails::CLIENT_STREAMING:
                $code = $this->rpcMethodExampleClientStreaming($snippetDetails);
                break;
            default:
                throw new \Exception("Cannot handle method-type: '{$snippetDetails->methodDetails->methodType}'");
        }
        $snippetDetails->context->finalize(null);
        return $code;
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function rpcMethodExampleNormal(SnippetDetails $snippetDetails): AST
    {
        $responseVar = AST::var('response');

        return $this->buildSnippetFunctions(
            $snippetDetails,
            [
                $this->buildClientMethodCall($snippetDetails, $responseVar),
                $this->buildPrintFCall(
                    $snippetDetails->methodDetails->hasEmptyResponse
                        ? "'Call completed successfully.'"
                        : "'Response data: %s' . PHP_EOL, {$responseVar->toCode()}->serializeToJsonString()"
                )
            ]
        );
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function rpcMethodExampleOperation(SnippetDetails $snippetDetails): AST
    {
        $responseVar = AST::var('response');
        $resultVar = AST::var('result');
        $errorVar = AST::var('error');
        $isCustomOp = $snippetDetails->methodDetails->methodType === MethodDetails::CUSTOM_OP;
        $context = $snippetDetails->context;

        return $this->buildSnippetFunctions(
            $snippetDetails,
            [
                $this->buildClientMethodCall($snippetDetails, $responseVar),
                $responseVar->pollUntilComplete(),
                PHP_EOL,
                AST::if($responseVar->operationSucceeded(), false)
                    ->then(
                        // Custom operations and google.protobuf.Empty responses have no result.
                        $isCustomOp || $snippetDetails->methodDetails->hasEmptyLroResponse
                            ? $this->buildPrintFCall("'Operation completed successfully.'")
                            : Vector::new([
                                AST::inlineVarDoc(
                                    $context->type($snippetDetails->methodDetails->lroResponseType),
                                    $responseVar
                                ),
                                AST::assign($resultVar, $responseVar->getResult()),
                                $this->buildPrintFCall(
                                    "'Operation successful with response data: %s' . PHP_EOL, {$resultVar->toCode()}->serializeToJsonString()"
                                )
                            ])
                    )->else(
                        AST::inlineVarDoc(
                            $context->type(Type::fromName(Status::class)),
                            $errorVar
                        ),
                        AST::assign($errorVar, $responseVar->getError()),
                        $this->buildPrintFCall(
                            "'Operation failed with error data: %s' . PHP_EOL, {$errorVar->toCode()}->serializeToJsonString()"
                        )
                    )
            ]
        );
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function rpcMethodExamplePaginated(SnippetDetails $snippetDetails): AST
    {
        $responseVar = AST::var('response');
        $elementVar = AST::var('element');
        $context = $snippetDetails->context;

        return $this->buildSnippetFunctions(
            $snippetDetails,
            [
                $this->buildClientMethodCall($snippetDetails, $responseVar),
                PHP_EOL,
                AST::inlineVarDoc(
                    $context->type($snippetDetails->methodDetails->resourceType),
                    $elementVar
                ),
                AST::foreach($responseVar, $elementVar)(
                    AST::call(AST::PRINT_F)(
                        AST::literal(
                            "'Element data: %s' . PHP_EOL, {$elementVar->toCode()}->serializeToJsonString()"
                        )
                    )
                )
            ]
        );
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function rpcMethodExampleBidiStreaming(SnippetDetails $snippetDetails): AST
    {
        $streamVar = AST::var('stream');
        $elementVar = AST::var('element');
        $context = $snippetDetails->context;

        return $this->buildSnippetFunctions(
            $snippetDetails,
            [
                $this->buildClientMethodCall($snippetDetails, $streamVar),
                $streamVar->writeAll($snippetDetails->rpcArguments),
                PHP_EOL,
                AST::inlineVarDoc(
                    $context->type($snippetDetails->methodDetails->responseType),
                    $elementVar
                ),
                AST::foreach($streamVar->closeWriteAndReadAll(), $elementVar)(
                    AST::call(AST::PRINT_F)(
                        AST::literal(
                            "'Element data: %s' . PHP_EOL, {$elementVar->toCode()}->serializeToJsonString()"
                        )
                    )
                )
            ]
        );
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function rpcMethodExampleServerStreaming(SnippetDetails $snippetDetails): AST
    {
        $streamVar = AST::var('stream');
        $elementVar = AST::var('element');
        $context = $snippetDetails->context;

        return $this->buildSnippetFunctions(
            $snippetDetails,
            [
                $this->buildClientMethodCall($snippetDetails, $streamVar),
                PHP_EOL,
                AST::inlineVarDoc(
                    $context->type($snippetDetails->methodDetails->responseType),
                    $elementVar
                ),
                AST::foreach($streamVar->readAll(), $elementVar)(
                    AST::call(AST::PRINT_F)(
                        AST::literal(
                            "'Element data: %s' . PHP_EOL, {$elementVar->toCode()}->serializeToJsonString()"
                        )
                    )
                )
            ]
        );
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function rpcMethodExampleClientStreaming(SnippetDetails $snippetDetails): AST
    {
        $streamVar = AST::var('stream');
        $responseVar = AST::var('response');
        $context = $snippetDetails->context;

        return $this->buildSnippetFunctions(
            $snippetDetails,
            [
                $this->buildClientMethodCall($snippetDetails, $streamVar),
                PHP_EOL,
                AST::inlineVarDoc(
                    $context->type($snippetDetails->methodDetails->responseType),
                    $responseVar
                ),
                AST::assign(
                    $responseVar,
                    $streamVar->writeAllAndReadResponse($snippetDetails->rpcArguments)
                ),
                AST::call(AST::PRINT_F)(
                    AST::literal(
                        "'Response data: %s' . PHP_EOL, {$responseVar->toCode()}->serializeToJsonString()"
                    )
                )
            ]
        );
    }

    /**
     * Defines the try/catch statement used to wrap every RPC.
     *
     * @param array $tryStatements
     * @param SnippetDetails $snippetDetails
     * @return AST
     */
    private function buildTryCatchStatement(array $tryStatements, SnippetDetails $snippetDetails): AST
    {
        $exceptionVar = AST::var('ex');

        return AST::try(...$tryStatements)
            ->catch(
                $snippetDetails
                    ->context
                    ->type(Type::fromName(ApiException::class)),
                $exceptionVar
            )(
                $this->buildPrintFCall("'Call failed with message: %s' . PHP_EOL, {$exceptionVar->toCode()}->getMessage()")
            );
    }

    /**
     * Defines the basic outline of the main sample and the "callSample" function if one is needed.
     *
     * @param SnippetDetails $snippetDetails
     * @param array $tryStatements
     * @return AST
     */
    private function buildSnippetFunctions(SnippetDetails $snippetDetails, array $tryStatements): AST
    {
        $sampleName = Helpers::toSnakeCase($snippetDetails->methodDetails->methodName) . '_sample';
        $hasSampleParams = count($snippetDetails->sampleParams) > 0;
        $hasSampleAssignments = count($snippetDetails->sampleAssignments) > 0;
        $callSampleFn = $hasSampleParams
            ? $this->buildCallSampleFunction($snippetDetails, $sampleName)
            : null;
        $sampleFn = AST::fn($sampleName)
            ->withPhpDoc(
                PhpDoc::block(
                    PhpDoc::preFormattedText($snippetDetails->methodDetails->docLines),
                    $snippetDetails->phpDocParams
                )
            )
            ->withParams($snippetDetails->sampleParams)
            ->withReturnType($snippetDetails->context->type(Type::void()))
            ->withBody(
                AST::block(
                    '// Create a client.',
                    AST::assign(
                        $snippetDetails->serviceClientVar,
                        AST::new(
                            $snippetDetails->context->type(
                                $this->serviceDetails->emptyClientType
                            )
                        )()
                    ),
                    $hasSampleAssignments ? PHP_EOL : null,
                    $hasSampleAssignments ? '// Prepare any non-scalar elements to be passed along with the request.' : null,
                    $snippetDetails->sampleAssignments,
                    PHP_EOL,
                    '// Call the API and handle any network failures.',
                    $this->buildTryCatchStatement($tryStatements, $snippetDetails)
                )
            );

        if (!$hasSampleParams) {
            $sampleFn = $sampleFn->withoutNewlineAfterDeclaration();
        }

        return AST::block(
            $sampleFn,
            $callSampleFn
        );
    }

    /**
     * The "callSample" function acts as an entry point for the main sample. If required, it also prepares basic scalar
     * assignments.
     *
     * @param SnippetDetails $snippetDetails
     * @param string $sampleName
     * @return PhpFunction
     */
    private function buildCallSampleFunction(SnippetDetails $snippetDetails, string $sampleName): PhpFunction
    {
        return AST::fn('callSample')
            ->withoutNewlineAfterDeclaration()
            ->withPhpDoc(
                PhpDoc::block(
                    PhpDoc::text('Helper to execute the sample.'),
                    PhpDoc::text('TODO(developer): Replace sample parameters before running the code.')
                )
            )
            ->withReturnType($snippetDetails->context->type(Type::void()))
            ->withBody(
                AST::block(
                    $snippetDetails->callSampleAssignments,
                    PHP_EOL,
                    AST::call("\0$sampleName")($snippetDetails->sampleArguments)
                )
            );
    }

    /**
     * @param SnippetDetails $snippetDetails
     * @param Variable $var
     * @return Vector
     */
    private function buildClientMethodCall(SnippetDetails $snippetDetails, Variable $var): Vector
    {
        $vector = Vector::new();
        $methodDetails = $snippetDetails->methodDetails;
        $returnType = $methodDetails->methodReturnType;

        if (!$methodDetails->hasEmptyResponse) {
            $vector = $vector->append(
                AST::inlineVarDoc(
                    $snippetDetails
                        ->context
                        ->type($returnType),
                    $var
                )
            );
        }
        $call = AST::call(
            $snippetDetails->serviceClientVar,
            AST::method($methodDetails->methodName)
        );
        $call = $methodDetails->isClientStreaming() || $methodDetails->isBidiStreaming()
            ? $call()
            : $call($snippetDetails->rpcArguments);
        return $vector->append(
            $methodDetails->hasEmptyResponse
                ? $call
                : AST::assign($var, $call)
        );
    }

    /**
     * @param string $str A string literal to be proxied to AST::literal.
     * @return AST
     */
    private function buildPrintFCall(string $str): AST
    {
        return AST::call(AST::PRINT_F)(
            AST::literal($str)
        );
    }

    /**
     * A region tag is used to identify a sample internally.
     *
     * @param string $methodName
     * @return string
     */
    private function generateRegionTag(string $methodName): string
    {
        $version = strtolower(Helpers::nsVersionAndSuffixPath($this->serviceDetails->namespace)) ?: '_';
        if ($version !== '_') {
            $version = '_' . $version . '_';
        }
        $serviceParts = explode('.', $this->serviceDetails->serviceName);
        $hostNameParts = explode('.', $this->serviceDetails->defaultHost);
        $serviceName = end($serviceParts);
        $shortName = $hostNameParts[0];

        return $shortName . $version . 'generated_' . $serviceName . '_' . $methodName . '_sync';
    }
}
