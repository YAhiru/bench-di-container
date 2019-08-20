<?php
declare(strict_types=1);

namespace DITest\Auryn;

use Auryn\Injector;
use DITest\BenchMark\BenchMarkableContainer;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;

final class AurynContainer implements BenchMarkableContainer
{
    /** @var Injector */
    private $container;

    public function __construct()
    {
        $this->container = new Injector;
    }

    public function setUp(): void
    {
        $this->container->define(FakeDBConnection::class, [
            ':host' => 'localhost',
            ':port' => 3306
        ]);
        $this->container->alias(DbConnection::class, FakeDBConnection::class);
        $this->container->alias(CacheInterface::class, FakeCache::class);
        $this->container->alias(Repository::class, DbRepository::class);
    }

    public function get($class)
    {
        return $this->container->make($class);
    }
}
