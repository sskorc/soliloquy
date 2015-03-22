<?php

namespace spec\Soliloquy\ProviderBundle\Provider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilmwebProviderSpec extends ObjectBehavior
{
    /**
     * @param Soliloquy\ParserBundle\Parser\FilmwebParser $parser
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    function let($parser, $movie)
    {
        $this->setParser($parser);
        $this->setMovie($movie);
    }

    /**
     * @param Soliloquy\ParserBundle\Parser\FilmwebParser $parser
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    function it_should_get_movie($parser, $movie)
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

        $this->getMovie($parameters)->shouldReturn($movie);
    }
}
