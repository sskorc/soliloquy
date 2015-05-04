<?php

namespace Soliloquy\MovieBundle\Factory;

use Soliloquy\MovieBundle\Document\Movie;
use Soliloquy\MovieBundle\Document\MovieProxy;

class MovieFactory
{
    /**
     * @param array $details
     *
     * @return Movie
     */
    public function createMovie($details = array())
    {
        $movie = new Movie();

        $movie->setPolishTitle($details['polishTitle']);
        $movie->setOriginalTitle($details['originalTitle']);
        $movie->setRating($details['rating']);
        $movie->setYearOfProduction($details['yearOfProduction']);

        return $movie;
    }

    /**
     * @param array $details
     *
     * @return MovieProxy
     */
    public function createMovieProxy($details = array())
    {
        $movieProxy = new MovieProxy();

        $movieProxy->setRate($details['rating']);
        $movieProxy->setIsFavourite($details['isFavourite']);
        $movieProxy->setRatedAt($details['ratedAt']);

        $movie = new Movie();
        $movie->setId($details['id']);
        $movieProxy->setMovie($movie);

        return $movieProxy;
    }
}
