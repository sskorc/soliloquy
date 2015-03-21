<?php

namespace Soliloquy\MovieBundle\Factory;

use Soliloquy\MovieBundle\Document\Movie;

class MovieFactory
{
    /**
     * @return Movie
     */
    public function createMovie()
    {
        return new Movie();
    }
}
