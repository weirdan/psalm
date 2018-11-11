<?php
namespace Psalm\PluginApi\Hook;

use PhpParser\Node\Expr;
use Psalm\Checker\StatementsChecker;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\FileManipulation\FileManipulation;

interface AfterExpressionCheckInterface
{
    /**
     * Called after an expression has been checked
     *
     * @param  string[]             $suppressed_issues
     * @param  FileManipulation[]   $file_replacements
     *
     * @return null|false
     */
    public static function afterExpressionCheck(
        StatementsChecker $statements_checker,
        Expr $stmt,
        Context $context,
        CodeLocation $code_location,
        array $suppressed_issues,
        array &$file_replacements = []
    );
}
