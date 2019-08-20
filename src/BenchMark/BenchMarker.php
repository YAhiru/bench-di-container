<?php
declare(strict_types=1);

namespace DITest\BenchMark;

class BenchMarker
{
    /** @var int[] */
    private $bench = [];
    /** @var int[] */
    private $results = [];

    public function start(string $key): void
    {
        $this->bench[$key] = microtime(true);
    }

    public function stop(string $key): void
    {
        if (array_key_exists($key, $this->bench)) {
            $this->results[$key] = microtime(true) - $this->bench[$key];
            unset($this->bench[$key]);
        }
    }

    public function result(): array
    {
        return $this->results;
    }
}
