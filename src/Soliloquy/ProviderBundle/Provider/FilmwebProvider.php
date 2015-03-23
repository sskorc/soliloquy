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
     * @var Soliloquy\UserBundle\Manager\DumpManager
     */
    protected $dumpManager;

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
     * @param Soliloquy\UserBundle\Manager\DumpManager $dumpManager
     */
    public function setDumpManager($dumpManager)
    {
        $this->dumpManager = $dumpManager;
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
            $movieProxy = $this->movieFactory->createMovieProxy();
            $movieProxy->setRate($userMovie['rating']);
            $movieProxy->setIsFavourite($userMovie['isFavourite']);
            $movieProxy->setRatedAt($userMovie['ratedAt']);

            $movie = $this->movieFactory->createMovie();
            $movie->setId($userMovie['id']);
            $movieProxy->setMovie($movie);

            $movies[] = $movieProxy;
        }

        return $movies;
    }

    /**
     * @param array $parameters
     *
     * @return Soliloquy\UserBundle\Document\Dump
     */
    public function importUserMovies($parameters)
    {
        $movies = $this->getUserMovies($parameters);

        $dump = $this->dumpManager->createDump();

        $dump->setMovies($movies);

        $this->dumpManager->persistDump($dump);

        return $dump;
    }
}
