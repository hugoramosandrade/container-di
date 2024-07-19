<?php

namespace HugoAndrade\ContainerDI\Container;

use HugoAndrade\ContainerDI\Exceptions\ContainerException;
use HugoAndrade\ContainerDI\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class DI implements ContainerInterface
{
    private static array $dependencies = [];

    public function get(string $id)
    {
        if (class_exists($id)) {
            return $this->resolve($id);
        }

        if ($this->hasNot($id)) throw new NotFoundException("No entry was found for {$id} identifier");

        $dependencies = self::$dependencies[$id];

        if (is_string($dependencies) && class_exists($dependencies)) {
            return $this->resolve($dependencies);
        }

        return $dependencies;
    }

    public function set(string $id, mixed $value): void
    {
        self::$dependencies[$id] = $value;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, self::$dependencies);
    }

    protected function hasNot(string $id): bool
    {
        return !$this->has($id);
    }

    protected function resolve(string $class): object
    {
        $reflectionClass = new ReflectionClass($class);

        $constructor = $reflectionClass->getConstructor();

        $params = $constructor?->getParameters();

        if ($params && count($params) > 0) {
            $constructorParams = [];
            foreach ($params as $param) {
                $dependencyClass = $param->getType();
                if ($dependencyClass instanceof \ReflectionType) {
                    /** @var ReflectionType $dependencyClass */
                    $type = $dependencyClass->getName();
                    if (class_exists($type)) {
                        $constructorParams[] = $this->resolve($dependencyClass->getName());
                    } else if (interface_exists($type) && $this->has($type)) {
                        $constructorParams[] = $this->resolve(self::$dependencies[$type]);
                    } else {
                        throw new ContainerException("Can't resolve entry '{$type}'");
                    }
                }
            }
            $object = $reflectionClass->newInstance(...$constructorParams);
        } else {
            $object = $reflectionClass->newInstance();
        }

        return $object;
    }

    public function getAll(): array
    {
        return self::$dependencies;
    }
}
