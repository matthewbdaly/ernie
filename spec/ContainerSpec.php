<?php

namespace spec\Matthewbdaly\Ernie;

use Matthewbdaly\Ernie\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Container::class);
    }

    function it_implements_interface()
    {
        $this->shouldImplement('Psr\Container\ContainerInterface');
    }

    function it_can_get_simple_classes()
    {
        $this->get('DateTime')->shouldReturnAnInstanceOf('DateTime');
    }

    function it_has_simple_classes()
    {
        $this->has('DateTime')->shouldReturn(true);
    }

    function it_returns_not_found_exception_if_class_cannot_be_found()
    {
        $this->shouldThrow('Matthewbdaly\Ernie\Exceptions\NotFoundException')
            ->duringGet('UnknownClass');
    }
}
