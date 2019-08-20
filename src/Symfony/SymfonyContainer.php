<?php
declare(strict_types=1);

namespace DITest\Symfony;

use DITest\BenchMark\BenchMarkableContainer;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class SymfonyContainer implements BenchMarkableContainer
{
    /** @var ContainerBuilder */
    private $container;

    public function __construct()
    {
        $this->container = new ContainerBuilder;
    }

    public function setUp(): void
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__));
        $loader->load('services.yml');
    }

    public function get($class)
    {
        return $this->container->get($class);
    }
}
