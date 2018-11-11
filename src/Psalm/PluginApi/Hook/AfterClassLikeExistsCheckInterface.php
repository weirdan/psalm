<?php
namespace Psalm\PluginApi\Hook;

use Psalm\CodeLocation;
use Psalm\FileManipulation\FileManipulation;
use Psalm\StatementsSource;

interface AfterClassLikeExistsCheckInterface
{
    /**
     * @param  string             $fq_class_name
     * @param  FileManipulation[] $file_replacements
     *
     * @return void
     */
    public static function afterClassLikeExistsCheck(
        StatementsSource $statements_source,
        $fq_class_name,
        CodeLocation $code_location,
        array &$file_replacements = []
    );
}
