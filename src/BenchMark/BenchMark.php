<?php
declare(strict_types=1);

namespace DITest\BenchMark;

use DITest\Repository;

final class BenchMark
{
    /** @var BenchMarker */
    private $bench;
    /** @var BenchMarkableContainer */
    private $container;

    const COUNT = 1000;

    public function __construct(BenchMarker $bench, BenchMarkableContainer $container)
    {
        $this->bench = $bench;
        $this->container = $container;
    }

    public function run(): array
    {
        $this->bench->start('total');

        $this->bench->start('setup');
        $this->container->setup();
        $this->bench->stop('setup');

        $cnt = self::COUNT;
        $this->bench->start('get');
        while ($cnt--) {
            $this->container->get(Repository::class);
        }
        $this->bench->stop('get');

        $this->bench->stop('total');

        return $this->bench->result();
    }
}
