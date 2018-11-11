<?php
namespace Psalm\PluginApi\Hook;

use PhpParser\Node\Arg;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\FileManipulation\FileManipulation;
use Psalm\StatementsSource;
use Psalm\Type\Union;

interface AfterMethodCallCheckInterface
{
    /**
     * @param  string $method_id - the method id being checked
     * @param  string $appearing_method_id - the method id of the class that the method appears in
     * @param  string $declaring_method_id - the method id of the class or trait that declares the method
     * @param  string|null $var_id - a reference to the LHS of the variable
     * @param  Arg[] $args
     * @param  FileManipulation[] $file_replacements
     *
     * @return void
     */
    public static function afterMethodCallCheck(
        StatementsSource $statements_source,
        $method_id,
        $appearing_method_id,
        $declaring_method_id,
        $var_id,
        array $args,
        CodeLocation $code_location,
        Context $context,
        array &$file_replacements = [],
        Union &$return_type_candidate = null
    );
}
