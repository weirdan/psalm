<?php
namespace Psalm\Provider;

use PhpParser;

class StatementsProvider
{
    /** @var ?PhpParser\Parser */
    protected static $parser;

    /**
     * @param  string  $file_path
     * @param  FileProvider $file_provider
     * @param  CacheProvider $cache_provider
     * @param  bool    $debug_output
     *
     * @return array<int, \PhpParser\Node\Stmt>
     */
    public static function getStatementsForFile(
        $file_path,
        ProjectChecker $project_checker,
        FileProvider $file_provider,
        CacheProvider $cache_provider,
        $debug_output = false
    ) {
        $stmts = [];

        $from_cache = false;

        $version = 'parsercache4.1' . ($project_checker->server_mode ? 'server' : '');

        $file_contents = $file_provider->getContents($file_path);
        $modified_time = $file_provider->getModifiedTime($file_path);

        $file_content_hash = md5($version . $file_contents);
        $file_cache_key = $cache_provider->getParserCacheKey($file_path);

        $stmts = $cache_provider->loadStatementsFromCache(
            $file_path,
            $modified_time,
            $file_content_hash,
            $file_cache_key
        );

        if ($stmts === null) {
            if ($debug_output) {
                echo 'Parsing ' . $file_path . PHP_EOL;
            }

            $stmts = self::parseStatementsInFile($project_checker, $file_contents);
        } else {
            $from_cache = true;
        }

        CacheProvider::saveStatementsToCache($file_cache_key, $file_content_hash, $stmts, $from_cache);

        if (!$stmts) {
            return [];
        }

        return $stmts;
    }

    /**
     * @param  string   $file_contents
     *
     * @return array<int, \PhpParser\Node\Stmt>
     */
    private static function parseStatementsInFile(ProjectChecker $project_checker, $file_contents)
    {
        if (!self::$parser) {
            $attributes = [
                'comments', 'startLine', 'startFilePos', 'endFilePos',
            ];

            if ($project_checker->server_mode) {
                $attributes[] = 'endLine';
            }

            $lexer = version_compare(PHP_VERSION, '7.0.0dev', '>=')
                ? new PhpParser\Lexer([ 'usedAttributes' => $attributes ])
                : new PhpParser\Lexer\Emulative([ 'usedAttributes' => $attributes ]);

            self::$parser = (new PhpParser\ParserFactory())->create(PhpParser\ParserFactory::PREFER_PHP7, $lexer);
        }

        $error_handler = new \PhpParser\ErrorHandler\Collecting();

        /** @var array<int, \PhpParser\Node\Stmt> */
        $stmts = $parser->parse($file_contents, $error_handler);

        if (!$stmts && $error_handler->hasErrors()) {
            foreach ($error_handler->getErrors() as $error) {
                throw $error;
            }
        }

        if ($project_checker->server_mode) {
            $traverser = new PhpParser\NodeTraverser;

            // Add parentNode, previousSibling, nextSibling attributes
            $traverser->addVisitor(new ReferencesAdder());

            // Add column attributes to nodes
            $traverser->addVisitor(new ColumnCalculator($file_contents));

            $traverser->traverse($stmts);
        }

        return $stmts;
    }
}
