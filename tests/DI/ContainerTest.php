<?php

namespace Testes\DI;

use HugoAndrade\ContainerDI\Container\DI;
use HugoAndrade\ContainerDI\Exceptions\ContainerException;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;
use stdClass;
use Testes\Abstract\TestInterface;
use Testes\Concrete\TestConcrete;
use Testes\Concrete\TestErrorClass;
use Testes\Concrete\TestService;

class ContainerTest extends TestCase
{
    private string $name = "Name Test";
    private string $undefinedDependency = 'nonexistent';
    private object $singleton;

    protected function setUp(): void
    {
        $container = DI::getInstance();
        $container->set(TestInterface::class, TestConcrete::class);
        $container->set('singleton', new stdClass);
        $singleton = container('singleton');
        $singleton->name = $this->name;
        $this->singleton = $singleton;
    }

    public function testGetObjectWithAllDependencies()
    {
        $containerTest = container();
        /** @var TestService */
        $service = $containerTest->get(TestService::class);
        $message = "Test message";

        $result = $service->returnMessage($message);

        self::assertInstanceOf(TestService::class, $service);
        self::assertEquals($message, $result);
        self::assertEquals(10, $service->getNumberDefaultValue());
    }

    public function testContainerMustThrowException()
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage("Can't resolve entry 'int'");
        container(TestErrorClass::class);
    }

    public function testHelperContainerMustReturnConcreteClass()
    {
        $concrete = container(TestInterface::class);

        self::assertInstanceOf(TestConcrete::class, $concrete);
    }

    public function testContainerMustReturnSameSingletonInstanceOfPreviousDefinition()
    {
        $singleton = container('singleton');

        self::assertEquals($this->singleton, $singleton);
        self::assertObjectHasProperty('name', $singleton);
        self::assertEquals($this->name, $singleton->name);
    }

    public function testContainerMustThrowNotFoundException()
    {
        $this->expectException(NotFoundExceptionInterface::class);
        $this->expectExceptionMessage("No entry was found for '{$this->undefinedDependency}' identifier");
        container($this->undefinedDependency);
    }
}
