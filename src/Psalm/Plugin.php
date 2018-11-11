<?php
namespace Psalm;

use PhpParser;
use Psalm\Checker\StatementsChecker;
use Psalm\FileManipulation\FileManipulation;
use Psalm\Scanner\FileScanner;
use Psalm\Storage\ClassLikeStorage;
use Psalm\Type\Union;
use Psalm\PluginApi\Hook;

abstract class Plugin implements
    Hook\AfterExpressionCheckInterface,
    Hook\AfterStatementCheckInterface,
    Hook\AfterVisitClassLikeInterface,
    Hook\AfterClassLikeExistsCheckInterface,
    Hook\AfterMethodCallCheckInterface,
    Hook\AfterFunctionCallCheckInterface
{
    public static function afterExpressionCheck(
        StatementsChecker $statements_checker,
        PhpParser\Node\Expr $stmt,
        Context $context,
        CodeLocation $code_location,
        array $suppressed_issues,
        array &$file_replacements = []
    ) {
        return null;
    }

    public static function afterStatementCheck(
        StatementsChecker $statements_checker,
        PhpParser\Node $stmt,
        Context $context,
        CodeLocation $code_location,
        array $suppressed_issues,
        array &$file_replacements = []
    ) {
        return null;
    }

    public static function afterVisitClassLike(
        PhpParser\Node\Stmt\ClassLike $stmt,
        ClassLikeStorage $storage,
        FileScanner $file,
        Aliases $aliases,
        array &$file_replacements = []
    ) {
    }

    public static function afterClassLikeExistsCheck(
        StatementsSource $statements_source,
        $fq_class_name,
        CodeLocation $code_location,
        array &$file_replacements = []
    ) {
    }

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
    ) {
    }

    public static function afterFunctionCallCheck(
        StatementsSource $statements_source,
        $function_id,
        array $args,
        CodeLocation $code_location,
        Context $context,
        array &$file_replacements = [],
        Union &$return_type_candidate = null
    ) {
    }
}
