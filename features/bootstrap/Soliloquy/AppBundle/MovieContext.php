<?php

namespace Soliloquy\AppBundle;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

class MovieContext implements Context, SnippetAcceptingContext
{
    use KernelDictionary;

    /**
     * @var \Soliloquy\MovieBundle\Document\Movie
     */
    protected $movie;

    /**
     * @When I request for movie :title details
     */
    public function iRequestForMovieDetails($title)
    {
        $parameters['title'] = $title;

        $this->movie = $this->getContainer()->get('soliloquy.app.movie')->getMovie($parameters);
    }

    /**
     * @Then I should get movie details
     */
    public function iShouldGetMovieDetails()
    {
        expect($this->movie)->toHaveType('\Soliloquy\MovieBundle\Document\Movie');
    }
}
