<?php

namespace Soliloquy\UserBundle\Document;

class Dump
{
    /**
     * @var \MongoId
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var array
     */
    protected $movies;

    public function __construct()
    {
        $this->id = new \MongoId();
        $this->createdAt = new \DateTime('now');
        $this->movies = array();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @param array $movies
     */
    public function setMovies($movies)
    {
        $this->movies = $movies;
    }

    /**
     * @param MovieProxy $movie
     */
    public function addMovie($movie)
    {
        $this->movies[] = $movie;
    }
}
