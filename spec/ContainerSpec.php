<?php

namespace spec\Matthewbdaly\Ernie;

use Matthewbdaly\Ernie\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use DateTime;

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

    function it_can_register_dependencies()
    {
        $toResolve = new class {
        };
        $this->set('Foo\Bar', $toResolve)->shouldReturn($this);
    }

    function it_can_resolve_registered_dependencies()
    {
        $toResolve = new class {
        };
        $this->set('Foo\Bar', $toResolve);
        $this->get('Foo\Bar')->shouldReturnAnInstanceOf($toResolve);
    }
    
    function it_can_resolve_registered_invokable()
    {
        $toResolve = new class {
            public function __invoke() {
                return new DateTime;
            }
        };
        $this->set('Foo\Bar', $toResolve);
        $this->get('Foo\Bar')->shouldReturnAnInstanceOf('DateTime');
    }
    
    function it_can_resolve_registered_callable()
    {
        $toResolve = function () {
            return new DateTime;
        };
        $this->set('Foo\Bar', $toResolve);
        $this->get('Foo\Bar')->shouldReturnAnInstanceOf('DateTime');
    }

    function it_can_resolve_if_registered_dependencies_instantiable()
    {
        $toResolve = new class {
        };
        $this->set('Foo\Bar', $toResolve);
        $this->has('Foo\Bar')->shouldReturn(true);
    }
}
