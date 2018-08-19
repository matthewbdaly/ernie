<?php

namespace Matthewbdaly\Ernie;

use Psr\Container\ContainerInterface;
use Matthewbdaly\Ernie\Exceptions\NotFoundException;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerInterface
{
    public function get($id)
    {
        try {
            return (new ReflectionClass($id))
                ->newInstance();
        } catch (ReflectionException $e) {
            throw new NotFoundException($e);
        }
    }

    public function has($id)
    {
    }
}
