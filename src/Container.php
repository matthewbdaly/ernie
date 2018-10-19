<?php

namespace Matthewbdaly\Ernie;

use Psr\Container\ContainerInterface;
use Matthewbdaly\Ernie\Exceptions\NotFoundException;
use ReflectionClass;
use ReflectionException;

/**
 * Container implementation
 */
class Container implements ContainerInterface
{
    private $services = [];

    /**
     * Get class
     *
     * @param mixed $id ID of class.
     * @return mixed
     * @throws NotFoundException Class not found.
     */
    public function get($id)
    {
        $item = $this->resolve($id);
        if ($item instanceof \ReflectionClass) {
            return $item->newInstance();
        }
        return $item;
    }

    /**
     * Does container have class?
     *
     * @param mixed $id ID of class.
     * @return boolean
     */
    public function has($id)
    {
        $item = $this->resolve($id);
        if ($item instanceof \ReflectionClass) {
            return $item->isInstantiable();
        }
        return isset($item);
    }

    /**
     * Set class
     *
     * @param string $key   Key to register.
     * @param mixed  $value Value to register.
     * @return Container
     */
    public function set(string $key, $value)
    {
        $this->services[$key] = $value;
        return $this;
    }

    /**
     * Resolve service from ID
     *
     * @param mixed $id ID of class.
     * @return mixed
     * @throws NotFoundException ID not found.
     */
    private function resolve($id)
    {
        try {
            if (isset($this->services[$id])) {
                if (is_callable($this->services[$id])) {
                    return $this->services[$id]();
                }
                return (new ReflectionClass($this->services[$id]));
            }
            return (new ReflectionClass($id));
        } catch (ReflectionException $e) {
            throw new NotFoundException($e);
        }
    }
}
