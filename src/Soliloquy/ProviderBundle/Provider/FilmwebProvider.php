<?php

namespace Soliloquy\ProviderBundle\Provider;

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

        $details = $this->parser->parseMovieDetailsPage($url);

        $movie = $this->movieFactory->createMovie();

        $movie->setPolishTitle($details['polishTitle']);
        $movie->setOriginalTitle($details['originalTitle']);
        $movie->setRating($details['rating']);
        $movie->setYearOfProduction($details['yearOfProduction']);

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

        $userMovies = $this->parser->parseUserMoviesListPage($parameters['username']);

        $movies = array();
        foreach ($userMovies as $userMovie) {
            $movie = $this->movieFactory->createMovie();
            $movie->setId($userMovie['id']);
            $movie->setRating($userMovie['rating']);
            $movie->setIsFavourite($userMovie['isFavourite']);
            $movie->setRatedAt($userMovie['ratedAt']);

            $details = $this->parser->parseMovieDetailsPage('http://www.filmweb.pl/entityLink?entityName=film&id=' . $userMovie['id']);

            $movie->setPolishTitle($details['polishTitle']);
            $movie->setOriginalTitle($details['originalTitle']);
            $movie->setYearOfProduction($details['yearOfProduction']);
            $movies[] = $movie;
        }

        return $movies;
    }
}
