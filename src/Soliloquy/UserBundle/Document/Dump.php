<?php

namespace Soliloquy\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Dump
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\Date
     */
    protected $createdAt;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Soliloquy\MovieBundle\Document\MovieProxy")
     */
    protected $movies;

    public function __construct()
    {
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
