<?php
declare(strict_types=1);

namespace DITest\League;

use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use League\Container\Container;
use Psr\SimpleCache\CacheInterface;

final class LeagueRegister
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public static function init(): Container
    {
        $container = new Container();
        $register = new self($container);
        $register->register();
        return $container;
    }

    public function register(): void
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
}
