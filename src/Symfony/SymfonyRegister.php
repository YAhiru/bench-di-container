<?php
declare(strict_types=1);

namespace DITest\Symfony;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class SymfonyRegister
{
    /** @var ContainerBuilder */
    private $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    public static function init(): ContainerBuilder
    {
        $container = new ContainerBuilder();
        $register = new self($container);
        $register->register();
        return $container;
    }

    public function register(): void
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__));
        $loader->load('services.yml');
    }
}
