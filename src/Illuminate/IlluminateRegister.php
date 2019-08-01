<?php
declare(strict_types=1);

namespace DITest\Illuminate;

use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Illuminate\Container\Container;
use Psr\SimpleCache\CacheInterface;

final class IlluminateRegister
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
        $this->container->bind(DbConnection::class, function () {
            return new FakeDBConnection('localhost', 3306);
        });
        $this->container->bind(CacheInterface::class, FakeCache::class);
        $this->container->bind(Repository::class, DbRepository::class);
    }
}
