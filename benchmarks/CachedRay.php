<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use DITest\Repository;
use DITest\Ray\RayRegister;

$tmpFile = dirname(__DIR__) . '/tmp/Ray/cache/di.cache.php';
$result = [];
$baseCnt = 1000;
file_put_contents($tmpFile, serialize(RayRegister::init()));

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $container = unserialize(file_get_contents($tmpFile));
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

