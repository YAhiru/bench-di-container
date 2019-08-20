<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

function bench(\DITest\BenchMark\BenchMarkableContainer $container): array
{
    return (new \DITest\BenchMark\BenchMark(
        new \DITest\BenchMark\BenchMarker,
        $container
    ))->run();
}

dd([
    'illuminate' => bench(new \DITest\Illuminate\IlluminateContainer),
    'symfony' => bench(new \DITest\Symfony\SymfonyContainer),
    'league' => bench(new \DITest\League\LeagueContainer),
    'phpdi' => bench(new \DITest\PHPDI\PHPDIContainer),
    'ray' => bench(new \DITest\Ray\RayContainer),
    'ray.cache' => bench(new \DITest\Ray\RayCachedContainer(__DIR__ . '/tmp/Ray/cache/di.cache.php')),
    'ray.compile' => bench(new \DITest\Ray\RayCompiledContainer(__DIR__ . '/tmp/Ray/compile')),
]);
