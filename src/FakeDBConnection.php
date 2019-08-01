<?php
declare(strict_types=1);

namespace DITest;

final class FakeDBConnection implements DbConnection
{
    /** @var string */
    private $host;
    /** @var int */
    private $port;

    /**
     * @param string $host
     * @param int $port
     */
    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function execute(string $query)
    {
        //
    }
}
