<?php

namespace Soliloquy\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
    public function getMovieAction(Request $request, $title)
    {
        $year = $request->get('year');

        $parameters['title'] = $title;
        $parameters['year'] = $year;

        $movie = $this->get('soliloquy.provider.filmweb')->getMovie($parameters);

        return $this->render(
            'SoliloquyWebBundle:Movie:single_movie.html.twig',
            array(
                'movie' => $movie,
            )
        );
    }
}
