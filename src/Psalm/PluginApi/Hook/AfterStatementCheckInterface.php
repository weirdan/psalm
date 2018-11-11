<?php
namespace Psalm\PluginApi\Hook;

use PhpParser\Node;
use Psalm\Checker\StatementsChecker;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\FileManipulation\FileManipulation;

interface AfterStatementCheckInterface
{
    /**
     * Called after a statement has been checked
     *
     * @param  Node\Stmt|Node\Expr  $stmt
     * @param  string[]                                 $suppressed_issues
     * @param  FileManipulation[]                       $file_replacements
     *
     * @return null|false
     */
    public static function afterStatementCheck(
        StatementsChecker $statements_checker,
        Node $stmt,
        Context $context,
        CodeLocation $code_location,
        array $suppressed_issues,
        array &$file_replacements = []
    );
}
