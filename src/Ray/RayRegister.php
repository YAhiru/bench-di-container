<?php
declare(strict_types=1);

namespace DITest\Ray;

use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;
use Ray\Di\AbstractModule;

final class RayRegister extends AbstractModule
{
    protected function configure()
    {
        $this->bind(DbConnection::class)->toConstructor(
            FakeDBConnection::class,
            ['host' => 'fake_db_connection_host', 'port' => 'fake_db_connection_port']
        );
        $this->bind()->annotatedWith('fake_db_connection_host')->toInstance('localhost');
        $this->bind()->annotatedWith('fake_db_connection_port')->toInstance(3306);
        $this->bind(CacheInterface::class)->to(FakeCache::class);
        $this->bind(Repository::class)->to(DbRepository::class);
    }
}
