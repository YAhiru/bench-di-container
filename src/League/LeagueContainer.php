<?php
declare(strict_types=1);

namespace DITest\League;

use DITest\BenchMark\BenchMarkableContainer;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use League\Container\Container;
use Psr\SimpleCache\CacheInterface;

final class LeagueContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = new Container;
    }

    public function setUp(): void
    {
        $this->container->add(DbConnection::class, function () {
            return new FakeDBConnection('localhost', 3306);
        });
        $this->container->add(CacheInterface::class, FakeCache::class);
        $this->container->add(Repository::class, function () {
            return new DbRepository(
                $this->container->get(DbConnection::class),
                $this->container->get(CacheInterface::class)
            );
        });
    }

    public function get($class)
    {
        return $this->container->get($class);
    }
}
