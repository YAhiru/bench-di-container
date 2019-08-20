<?php
declare(strict_types=1);

namespace DITest\PHPDI;

use DI\Container;
use DI\ContainerBuilder;
use DITest\BenchMark\BenchMarkableContainer;

final class PHPDICompiledContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;
    /** @var ContainerBuilder */
    private $builder;

    public function __construct(string $compileDir)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '/config.php');
        $builder->enableCompilation($compileDir);
        $this->builder = $builder;
    }

    public function setUp(): void
    {
        $this->container = $this->builder->build();
    }

    public function get($class)
    {
        return $this->container->get($class);
    }
}
