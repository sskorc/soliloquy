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

    public function getUserMoviesAction(Request $request, $username)
    {
        $parameters['username'] = $username;
        $parameters['password'] = $request->get('password');

        $movies = $this->get('soliloquy.provider.filmweb')->getUserMovies($parameters);

        return $this->render(
            'SoliloquyWebBundle:Movie:user_movies.html.twig',
            array(
                'movies' => $movies,
            )
        );
    }

    public function importUserMoviesAction(Request $request, $username)
    {
        $parameters['username'] = $username;
        $parameters['password'] = $request->get('password');

        $dump = $this->get('soliloquy.provider.filmweb')->importUserMovies($parameters);

        return $this->render(
            'SoliloquyWebBundle:Movie:dump.html.twig',
            array(
                'dump' => $dump,
            )
        );
    }
}
