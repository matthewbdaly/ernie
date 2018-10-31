<?php declare(strict_types = 1);

namespace Matthewbdaly\Ernie\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Exception;

/**
 * Class not found
 */
class NotFoundException extends Exception implements NotFoundExceptionInterface
{
}
