<?php

namespace Soliloquy\WebBundle;

use Behat\MinkBundle\Driver\SymfonyDriver;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

class MovieContext extends MinkContext implements SnippetAcceptingContext
{
    use KernelDictionary;

    /**
     * @When I request for movie :title details
     */
    public function iRequestForMovieDetails($title)
    {
        $this->visit('/browse/movie/' . $title);
    }

    /**
     * @Then I should get movie details
     */
    public function iShouldGetMovieDetails()
    {
        $this->assertPageContainsText('Polish title');
        $this->assertPageContainsText('Original title');
        $this->assertPageContainsText('Year');
        $this->assertPageContainsText('Rating');
    }
}
