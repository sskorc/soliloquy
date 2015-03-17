<?php

namespace Soliloquy\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    public function getMovieAction($title)
    {
        return $this->render('SoliloquyWebBundle:Movie:single_movie.html.twig', array('title' => $title));
    }
}
