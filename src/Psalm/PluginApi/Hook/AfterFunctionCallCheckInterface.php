<?php
namespace Psalm\PluginApi\Hook;

use PhpParser\Node\Arg;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\FileManipulation\FileManipulation;
use Psalm\StatementsSource;
use Psalm\Type\Union;

interface AfterFunctionCallCheckInterface
{
    /**
     * @param  string $function_id - the method id being checked
     * @param  Arg[] $args
     * @param  FileManipulation[] $file_replacements
     *
     * @return void
     */
    public static function afterFunctionCallCheck(
        StatementsSource $statements_source,
        $function_id,
        array $args,
        CodeLocation $code_location,
        Context $context,
        array &$file_replacements = [],
        Union &$return_type_candidate = null
    );
}
