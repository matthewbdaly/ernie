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
        try {
            if (isset($this->services[$id])) {
                return (new ReflectionClass($this->services[$id]))
                    ->newInstance();
            }
            return (new ReflectionClass($id))
                ->newInstance();
        } catch (ReflectionException $e) {
            throw new NotFoundException($e);
        }
    }

    /**
     * Does container have class?
     *
     * @param mixed $id ID of class.
     * @return boolean
     */
    public function has($id)
    {
        return (new ReflectionClass($id))->isInstantiable();
    }

    public function set(string $key, $value)
    {
        $this->services[$key] = $value;
        return $this;
    }
}
