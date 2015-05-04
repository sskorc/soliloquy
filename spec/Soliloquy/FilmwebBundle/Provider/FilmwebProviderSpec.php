<?php

namespace spec\Soliloquy\FilmwebBundle\Provider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilmwebProviderSpec extends ObjectBehavior
{
    /**
     * @param Soliloquy\FilmwebBundle\Parser\FilmwebParser $parser
     * @param Soliloquy\MovieBundle\Factory\MovieFactory $movieFactory
     */
    function let($parser, $movieFactory)
    {
        $this->setParser($parser);
        $this->setMovieFactory($movieFactory);
    }

    /**
     * @param Soliloquy\FilmwebBundle\Parser\FilmwebParser $parser
     * @param Soliloquy\MovieBundle\Factory\MovieFactory $movieFactory
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    function it_should_get_movie($parser, $movieFactory, $movie)
    {
        $parameters = array(
            'title' => 'Some title',
        );
        $details = array(
            'polishTitle' => 'Some title',
            'originalTitle' => 'Some title',
            'rating' => '6,5',
            'yearOfProduction' => '2015',
        );
        $url = 'some_url';

        $parser->findMovieUrl($parameters)->willReturn($url);
        $parser->parseMovieDetailsPage($url)->willReturn($details);
        $movieFactory->createMovie($details)->willReturn($movie);

        $this->getMovie($parameters)->shouldReturn($movie);
    }

    /**
     * @param Soliloquy\FilmwebBundle\Parser\FilmwebParser $parser
     * @param Soliloquy\MovieBundle\Factory\MovieFactory $movieFactory
     * @param Soliloquy\MovieBundle\Document\MovieProxy $movieProxy
     */
    function it_should_get_user_movies($parser, $movieFactory, $movieProxy)
    {
        $parameters = array(
            'username' => 'john',
            'password' => 'stdpass',
        );
        $moviesDetails[] = array(
            'polishTitle' => 'Some title',
            'originalTitle' => 'Some title',
            'rating' => '6,5',
            'yearOfProduction' => '2015',
        );

        $parser->login($parameters['username'], $parameters['password'])->shouldBeCalled();
        $parser->parseUserMoviesListPage($parameters['username'])->willReturn($moviesDetails);
        $movieFactory->createMovieProxy($moviesDetails[0])->willReturn($movieProxy);

        $this->getUserMovies($parameters)->shouldReturn(array($movieProxy));
    }
}
