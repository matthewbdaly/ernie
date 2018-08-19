<?php

namespace spec\Matthewbdaly\Ernie\Exceptions;

use Matthewbdaly\Ernie\Exceptions\ContainerException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ContainerException::class);
    }

    function it_implements_interface()
    {
        $this->shouldImplement('Psr\Container\ContainerExceptionInterface');
    }
}