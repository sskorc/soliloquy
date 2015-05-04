<?php

namespace spec\Soliloquy\AppBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieServiceSpec extends ObjectBehavior
{
    /**
     * @param Soliloquy\FilmwebBundle\Provider\FilmwebProvider $provider
     */
    function let($provider)
    {
        $this->beConstructedWith($provider);
    }

    /**
     * @param Soliloquy\FilmwebBundle\Provider\FilmwebProvider $provider
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    function it_should_get_movie($provider, $movie)
    {
        $parameters = array(
            'title' => 'Some title',
        );

        $provider->getMovie($parameters)->willReturn($movie);

        $this->getMovie($parameters)->shouldReturn($movie);
    }
}
