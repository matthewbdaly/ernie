<?php

namespace Matthewbdaly\Ernie;

use Psr\Container\ContainerInterface;
use ReflectionClass;

class Container implements ContainerInterface
{
    public function get($id)
    {
        return (new ReflectionClass($id))
            ->newInstance();
    }

    public function has($id)
    {
    }
}
