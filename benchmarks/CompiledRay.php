<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use DITest\Repository;
use Ray\Compiler\DiCompiler;
use DITest\Ray\RayRegister;
use Ray\Compiler\ScriptInjector;

$tmpDir = dirname(__DIR__) . '/tmp/Ray/compile';
$baseCnt = 1000;
$compiler = new DiCompiler(new RayRegister, $tmpDir);
$compiler->compile();

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $container = new ScriptInjector($tmpDir);
}
$result['init'] = (microtime(true) - $start);
$result['init.average'] = $result['init'] / $baseCnt;

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $repo = $container->getInstance(Repository::class);
}
$result['get'] = (microtime(true) - $start);
$result['get.average'] = $result['get'] / $baseCnt;

return $result;

