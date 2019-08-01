<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use DITest\Repository;
use DITest\League\LeagueRegister;

$result = [];
$baseCnt = 1000;

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $container = LeagueRegister::init();
}
$result['init'] = (microtime(true) - $start);
$result['init.average'] = $result['init'] / $baseCnt;

$cnt = $baseCnt;
$start = microtime(true);
while ($cnt--) {
    $repo = $container->get(Repository::class);
}
$result['get'] = (microtime(true) - $start);
$result['get.average'] = $result['get'] / $baseCnt;

return $result;

