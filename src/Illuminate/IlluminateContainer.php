<?php
declare(strict_types=1);

namespace DITest\Illuminate;

use DITest\BenchMark\BenchMarkableContainer;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Illuminate\Container\Container;
use Psr\SimpleCache\CacheInterface;

final class IlluminateContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = new Container;
    }

    public function setUp(): void
    {
        $this->container->bind(DbConnection::class, function () {
            return new FakeDBConnection('localhost', 3306);
        });
        $this->container->bind(CacheInterface::class, FakeCache::class);
        $this->container->bind(Repository::class, DbRepository::class);
    }

    public function get($class)
    {
        return $this->container->get($class);
    }
}
