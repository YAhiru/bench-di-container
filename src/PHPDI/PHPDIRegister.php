<?php
declare(strict_types=1);

namespace DITest\PHPDI;

use DI\Container;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;
use function DI\autowire;
use function DI\create;

final class PHPDIRegister
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
        $this->container->set(DbConnection::class, \DI\factory(function () {
            return new FakeDBConnection('localhost', 3306);
        }));
        $this->container->set(CacheInterface::class, create(FakeCache::class));
        $this->container->set(Repository::class, autowire(DbRepository::class));
    }
}
