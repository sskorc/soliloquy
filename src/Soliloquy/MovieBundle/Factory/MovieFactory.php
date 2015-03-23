<?php

namespace Soliloquy\MovieBundle\Factory;

use Soliloquy\MovieBundle\Document\Movie;
use Soliloquy\MovieBundle\Document\MovieProxy;

class MovieFactory
{
    /**
     * @return Movie
     */
    public function createMovie()
    {
        return new Movie();
    }

    /**
     * @return MovieProxy
     */
    public function createMovieProxy()
    {
        return new MovieProxy();
    }
}
