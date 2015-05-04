<?php

namespace spec\Soliloquy\MovieBundle\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieFactorySpec extends ObjectBehavior
{
    function it_should_create_movie()
    {
        $details = array(
            'polishTitle' => 'Some title',
            'originalTitle' => 'Some title',
            'rating' => '6,5',
            'yearOfProduction' => '2015',
        );

        $this->createMovie($details)->shouldReturnAnInstanceOf('Soliloquy\MovieBundle\Document\Movie');
    }

    function it_should_create_movie_proxy()
    {
        $details = array(
            'rating' => '8',
            'isFavourite' => true,
            'ratedAt' => new \DateTime(),
            'id' => '123',
        );

        $this->createMovieProxy($details)->shouldReturnAnInstanceOf('Soliloquy\MovieBundle\Document\MovieProxy');
    }
}
