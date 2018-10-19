<?php

namespace Fixtures;

use DateTime;

class ClassWithDependencies
{
    public $datetime;

    public function __construct(DateTime $datetime)
    {
        $this->datetime = $datetime;
    }
}
