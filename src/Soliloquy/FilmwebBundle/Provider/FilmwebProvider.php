<?php

namespace Soliloquy\FilmwebBundle\Provider;

class FilmwebProvider
{
    /**
     * @var Soliloquy\ParserBundle\Parser\FilmwebParser
     */
    protected $parser;

    /**
     * @var Soliloquy\MovieBundle\Document\MovieFactory
     */
    protected $movieFactory;

    /**
     * @param Soliloquy\ParserBundle\Parser\FilmwebParser $parser
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param Soliloquy\MovieBundle\Document\MovieFactory $movieFactory
     */
    public function setMovieFactory($movieFactory)
    {
        $this->movieFactory = $movieFactory;
    }

    /**
     * @param array $parameters
     *
     * @return Soliloquy\MovieBundle\Document\Movie
     */
    public function getMovie($parameters)
    {
        $url = $this->parser->findMovieUrl($parameters);

        $movieDetails = $this->parser->parseMovieDetailsPage($url);

        $movie = $this->movieFactory->createMovie($movieDetails);

        return $movie;
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    public function getUserMovies($parameters)
    {
        $this->parser->login($parameters['username'], $parameters['password']);

        $moviesDetails = $this->parser->parseUserMoviesListPage($parameters['username']);

        $movies = array();
        foreach ($moviesDetails as $movieDetails) {
            $movies[] = $this->movieFactory->createMovieProxy($movieDetails);
        }

        return $movies;
    }
}
