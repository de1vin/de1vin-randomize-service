<?php

namespace App\Component;


use ReflectionClass;

/**
 * Class Container
 */
class Container
{
    private array $map = [];

    /**
     * @param array $map
     */
    public function __construct(array $map) {
        $this->map = $map;
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->objects[$id]);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get(string $id): mixed
    {
        return $this->map[$id] ?? $this->prepareClass($id);
    }

    /**
     * @param string $className
     *
     * @return ?object
     *
     * @throws
     */
    private function prepareClass(string $className): ?object
    {
        if (!class_exists($className)) {
            return null;
        }

        $classReflector = new ReflectionClass($className);
        $constructReflector = $classReflector->getConstructor();

        if (empty($constructReflector)) {
            return new $className;
        }

        $constructArguments = $constructReflector->getParameters();

        if (empty($constructArguments)) {
            return new $className;
        }

        $args = [];

        foreach ($constructArguments as $argument) {
            $argumentType = $argument->getType()->getName();
            $args[$argument->getName()] = $this->get($argumentType);
        }

        $this->map[$className] = new $className(...$args);

        return $this->map[$className];
    }
}
