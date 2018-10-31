<?php declare(strict_types = 1);

namespace Matthewbdaly\Ernie\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use Exception;

/**
 * Class could not be instantiated
 */
class ContainerException extends Exception implements ContainerExceptionInterface
{
}
