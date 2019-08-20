<?php
declare(strict_types=1);

namespace DITest\PHPDI;

use function DI\autowire;
use DI\Container;
use DI\ContainerBuilder;
use function DI\create;
use function DI\get;
use DITest\BenchMark\BenchMarkableContainer;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;

final class PHPDICachedContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;
    /** @var ContainerBuilder */
    private $builder;

    public function __construct()
    {
        $builder = new ContainerBuilder;
        $builder->addDefinitions(__DIR__ . '/config.php');
        $builder->enableDefinitionCache();
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
