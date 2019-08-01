<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use DITest\Repository;
use DITest\Ray\RayRegister;

$result = [];
$baseCnt = 1000;

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $container = RayRegister::init();
}
$result['init'] = (microtime(true) - $start);
$result['init.average'] = $result['init'] / $baseCnt;

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $container->getInstance(Repository::class);
}
$result['get'] = (microtime(true) - $start);
$result['get.average'] = $result['get'] / $baseCnt;

return $result;

