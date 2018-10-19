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
}
