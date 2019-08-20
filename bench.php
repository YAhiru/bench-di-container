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

$tmpDir = __DIR__.'/tmp';
dd([
    'illuminate' => bench(new \DITest\Illuminate\IlluminateContainer),
    'symfony' => bench(new \DITest\Symfony\SymfonyContainer),
    'league' => bench(new \DITest\League\LeagueContainer),
    'phpdi' => bench(new \DITest\PHPDI\PHPDIContainer),
    'phpdi.cache' => bench(new \DITest\PHPDI\PHPDICachedContainer),
    'phpdi.compile' => bench(new \DITest\PHPDI\PHPDICompiledContainer($tmpDir.'/PHPDI/compile')),
    'ray' => bench(new \DITest\Ray\RayContainer),
    'ray.cache' => bench(new \DITest\Ray\RayCachedContainer($tmpDir.'/Ray/cache/di.cache.php')),
    'ray.compile' => bench(new \DITest\Ray\RayCompiledContainer($tmpDir.'/Ray/compile')),
    'aura' => bench(new \DITest\Aura\AuraContainer),
    'aura.serialized' => bench(new \DITest\Aura\AuraSerializedContainer($tmpDir.'/Aura/serialized/cache')),
    'auryn' => bench(new \DITest\Auryn\AurynContainer),
]);
