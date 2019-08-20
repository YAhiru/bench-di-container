<?php
declare(strict_types=1);

use function DI\autowire;
use function DI\create;
use function DI\get;
use DITest\DbConnection;
use DITest\DbRepository;
use DITest\FakeCache;
use DITest\FakeDBConnection;
use DITest\Repository;
use Psr\SimpleCache\CacheInterface;

return [
    'db.host' => 'localhost',
    'db.port' => 3306,

    DbConnection::class => create(FakeDBConnection::class)
                            ->constructor(get('db.host'), get('db.port')),
    CacheInterface::class => create(FakeCache::class),
    Repository::class => autowire(DbRepository::class),
];
