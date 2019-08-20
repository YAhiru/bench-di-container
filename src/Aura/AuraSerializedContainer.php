<?php
declare(strict_types=1);

namespace DITest\Aura;

use Aura\Di\Container;
use DITest\BenchMark\BenchMarkableContainer;

final class AuraSerializedContainer implements BenchMarkableContainer
{
    /** @var Container */
    private $container;
    /** @var string */
    private $serializeFilePath;

    public function __construct(string $serializeFilePath)
    {
        $this->serializeFilePath = $serializeFilePath;

        if (!is_file($serializeFilePath)) {
            $container = new AuraContainer;
            $container->setUp();
            file_put_contents($serializeFilePath, serialize($container->getContainer()));
        }
    }

    public function setUp(): void
    {
        $this->container = unserialize(file_get_contents($this->serializeFilePath));
    }

    public function get($class)
    {
        return $this->container->get($class);
    }
}
