<?php
declare(strict_types=1);

namespace DITest\Ray;

use DITest\BenchMark\BenchMarkableContainer;
use Ray\Di\Injector;

final class RayCachedContainer implements BenchMarkableContainer
{
    /** @var Injector */
    private $container;
    /** @var string */
    private $cacheFilePath;

    public function __construct(string $cacheFilePath)
    {
        $this->cacheFilePath = $cacheFilePath;

        if (!is_file($cacheFilePath)) {
            $container = new RayContainer;
            $container->setUp();
            file_put_contents($cacheFilePath, serialize($container->getContainer()));
        }
    }

    public function setUp(): void
    {
        $this->container = unserialize(file_get_contents($this->cacheFilePath));
    }

    public function get($class)
    {
        return $this->container->getInstance($class);
    }
}
