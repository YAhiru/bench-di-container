<?php
declare(strict_types=1);

namespace DITest\PHPDI;

use DI\Container;
use DITest\BenchMark\BenchMarkableContainer;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;
use function DI\autowire;
use function DI\create;

final class PHPDIContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = new Container;
    }

    public function setUp(): void
    {
        $this->container->set(DbConnection::class, \DI\factory(function () {
            return new FakeDBConnection('localhost', 3306);
        }));
        $this->container->set(CacheInterface::class, create(FakeCache::class));
        $this->container->set(Repository::class, autowire(DbRepository::class));
    }

    public function get($class)
    {
        return $this->container->get($class);
    }
}
