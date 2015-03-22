<?php

namespace Soliloquy\ProviderBundle\Provider;

class FilmwebProvider
{
    /**
     * @var Soliloquy\ParserBundle\Parser\FilmwebParser
     */
    protected $parser;

    /**
     * @var Soliloquy\MovieBundle\Document\Movie
     */
    protected $movie;

    /**
     * @param Soliloquy\ParserBundle\Parser\FilmwebParser $parser
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

    /**
     * @param array $parameters
     *
     * @return Soliloquy\MovieBundle\Document\Movie
     */
    public function getMovie($parameters)
    {
        $url = $this->parser->findMovieUrl($parameters);

        $details = $this->parser->parseMovieDetailsPage($url);

        $this->movie->setPolishTitle($details['polishTitle']);
        $this->movie->setOriginalTitle($details['originalTitle']);
        $this->movie->setRating($details['rating']);
        $this->movie->setYearOfProduction($details['yearOfProduction']);

        return $this->movie;
    }
}
