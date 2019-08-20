<?php
declare(strict_types=1);

namespace DITest\BenchMark;

interface BenchMarkableContainer
{
    public function setUp(): void;
    public function get($class);
}
