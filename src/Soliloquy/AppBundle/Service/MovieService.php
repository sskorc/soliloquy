<?php

namespace Soliloquy\AppBundle\Service;

class MovieService
{
    protected $provider;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    public function getMovie($parameters)
    {
        return $this->provider->getMovie($parameters);
    }
}
