<?php

namespace spec\Soliloquy\AppBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImportServiceSpec extends ObjectBehavior
{
    /**
     * @param Soliloquy\FilmwebBundle\Provider\FilmwebProvider $provider
     * @param Soliloquy\UserBundle\Manager\DumpManager $dumpManager
     */
    function let($provider, $dumpManager)
    {
        $this->beConstructedWith($provider, $dumpManager);
    }

    /**
     * @param Soliloquy\FilmwebBundle\Provider\FilmwebProvider $provider
     * @param Soliloquy\UserBundle\Manager\DumpManager $dumpManager
     * @param Soliloquy\UserBundle\Document\Dump $dump
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    function it_should_import_user_movies($provider, $dumpManager, $dump, $movie)
    {
        $movies = array($movie);
        $parameters = array(
            'username' => 'john',
            'password' => 'stdpass',
        );

        $provider->getUserMovies($parameters)->willReturn($movies);
        $dumpManager->createDump($movies)->willReturn($dump);

        $dumpManager->persistDump($dump)->shouldBeCalled();
        $this->importUserMovies($parameters)->shouldReturn($dump);
    }
}
