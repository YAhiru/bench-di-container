<?php
declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

function bench(string $file): array
{
    return require_once $file;
}

dd([
    'illuminate' => bench('./benchmarks/Illuminate.php'),
    'symfony' => bench('./benchmarks/Symfony.php'),
    'league' => bench('./benchmarks/League.php'),
    'phpdi' => bench('./benchmarks/PHPDI.php'),
    'ray' => bench('./benchmarks/Ray.php'),
    'ray.cache' => bench('./benchmarks/CachedRay.php'),
    'ray.compile' => bench('./benchmarks/CompiledRay.php'),
]);
