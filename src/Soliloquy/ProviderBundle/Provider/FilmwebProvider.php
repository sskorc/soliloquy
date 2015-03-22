<?php

namespace Soliloquy\ProviderBundle\Provider;

class FilmwebProvider
{
    /**
     * @var Soliloquy\ParserBundle\Parser\FilmwebParser
     */
    protected $parser;

    /**
     * @param Soliloquy\ParserBundle\Parser\FilmwebParser $parser
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param array $parameters
     *
     * @return Soliloquy\MovieBundle\Document\Movie
     */
    public function getMovie($parameters)
    {
        $url = $this->parser->findMovieUrl($parameters);

        $movie = $this->parser->parseMovieDetailsPage($url);

        return $movie;
    }
}
