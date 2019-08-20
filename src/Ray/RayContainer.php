<?php
declare(strict_types=1);

namespace DITest\Ray;

use DITest\BenchMark\BenchMarkableContainer;
use Ray\Di\Injector;

final class RayContainer implements BenchMarkableContainer
{
    /** @var Injector */
    private $container;

    public function setUp(): void
    {
        $this->container = new Injector(new RayRegister);
    }

    public function get($class)
    {
        return $this->container->getInstance($class);
    }

    public function getContainer(): Injector
    {
        return $this->container;
    }
}
