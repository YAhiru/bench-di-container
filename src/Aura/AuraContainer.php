<?php
declare(strict_types=1);

namespace DITest\Aura;

use Aura\Di\Container;
use Aura\Di\ContainerBuilder;
use DITest\BenchMark\BenchMarkableContainer;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;

final class AuraContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $builder = new ContainerBuilder;
        $this->container = $builder->newInstance(ContainerBuilder::AUTO_RESOLVE);
    }

    public function setUp(): void
    {
        $this->container->set(DbConnection::class, $this->container->lazyNew(FakeDBConnection::class, [
            'host' => 'localhost',
            'port' => 3306
        ]));
        $this->container->set(CacheInterface::class, $this->container->lazyNew(FakeCache::class));

        $this->container->set(Repository::class, $this->container->lazyNew(
            DbRepository::class, [
            'con' => $this->container->lazyGet(DbConnection::class),
            'cache' => $this->container->lazyGet(CacheInterface::class)
        ]));
    }

    public function get($class)
    {
        return $this->container->get($class);
    }

    public function getContainer(): Container
    {
        return $this->container;
    }
}
