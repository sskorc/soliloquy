<?php

namespace Soliloquy\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
    public function getMovieAction(Request $request, $title)
    {
        $parameters['title'] = $title;
        $parameters['year'] = $request->get('year');

        $movie = $this->get('soliloquy.app.movie')->getMovie($parameters);

        return $this->render(
            'SoliloquyWebBundle:Movie:single_movie.html.twig',
            array(
                'movie' => $movie,
            )
        );
    }

    public function importUserMoviesAction(Request $request, $username)
    {
        $parameters['username'] = $username;
        $parameters['password'] = $request->get('password');

        $dump = $this->get('soliloquy.app.import')->importUserMovies($parameters);

        return $this->render(
            'SoliloquyWebBundle:Movie:dump.html.twig',
            array(
                'dump' => $dump,
            )
        );
    }
}
