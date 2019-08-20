<?php
declare(strict_types=1);

namespace DITest\Ray;

use DITest\BenchMark\BenchMarkableContainer;
use Ray\Compiler\DiCompiler;
use Ray\Compiler\ScriptInjector;
use Ray\Di\Injector;

final class RayCompiledContainer implements BenchMarkableContainer
{
    /** @var Injector */
    private $container;
    /** @var string */
    private $compileDirPath;

    public function __construct(string $compileDirPath)
    {
        $this->compileDirPath = $compileDirPath;

        if (!is_file($compileDirPath)) {
            $compiler = new DiCompiler(new RayRegister, $compileDirPath);
            $compiler->compile();
        }
    }

    public function setUp(): void
    {
        $this->container = new ScriptInjector($this->compileDirPath);
    }

    public function get($class)
    {
        return $this->container->getInstance($class);
    }
}
