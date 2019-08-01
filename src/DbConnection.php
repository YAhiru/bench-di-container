<?php
declare(strict_types=1);

namespace DITest;

interface DbConnection
{
    public function execute(string $query);
}
