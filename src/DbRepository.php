<?php
declare(strict_types=1);

namespace DITest;

use Psr\SimpleCache\CacheInterface;

final class DbRepository implements Repository
{
    /** @var DbConnection */
    private $con;
    /** @var CacheInterface */
    private $cache;

    public function __construct(DbConnection $con, CacheInterface $cache)
    {
        $this->con = $con;
        $this->cache = $cache;
    }

    public function find(int $id)
    {
        //
    }
}
