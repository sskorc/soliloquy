<?php

namespace spec\Soliloquy\MovieBundle\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieFactorySpec extends ObjectBehavior
{
    function it_should_create_movie()
    {
        $this->createMovie()->shouldReturnAnInstanceOf('Soliloquy\MovieBundle\Document\Movie');
    }
}
