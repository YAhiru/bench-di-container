<?php
declare(strict_types=1);

namespace DITest;

interface Repository
{
    public function find(int $id);
}
