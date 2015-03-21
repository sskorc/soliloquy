<?php

namespace Soliloquy\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    public function getMovieAction($title)
    {
        $url = 'http://www.filmweb.pl/film/Wilk+z+Wall+Street-2013-426597';

        $movie = $this->get('soliloquy.parser.filmweb')->parseMovieDetailsPage($url);

        return $this->render(
            'SoliloquyWebBundle:Movie:single_movie.html.twig',
            array(
                'polish_title' => $movie->getPolishTitle(),
                'original_title' => $movie->getOriginalTitle(),
                'rating' => 10,
            )
        );
    }
}
