<?php
namespace Psalm\PluginApi\Hook;

use PhpParser\Node\Stmt\ClassLike;
use Psalm\Aliases;
use Psalm\FileManipulation\FileManipulation;
use Psalm\Scanner\FileScanner;
use Psalm\Storage\ClassLikeStorage;

interface AfterVisitClassLikeInterface
{
    /**
     * @param  FileManipulation[] $file_replacements
     *
     * @return void
     */
    public static function afterVisitClassLike(
        ClassLike $stmt,
        ClassLikeStorage $storage,
        FileScanner $file,
        Aliases $aliases,
        array &$file_replacements = []
    );
}
