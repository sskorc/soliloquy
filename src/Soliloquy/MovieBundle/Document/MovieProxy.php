<?php

namespace Soliloquy\MovieBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class MovieProxy
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Soliloquy\MovieBundle\Document\Movie")
     */
    protected $movie;

    /**
     * @MongoDB\Date
     */
    protected $ratedAt;

    /**
     * @MongoDB\String
     */
    protected $rate;

    /**
     * @MongoDB\Boolean
     */
    protected $isFavourite;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param Movie $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

    /**
     * @return \DateTime
     */
    public function getRatedAt()
    {
        return $this->ratedAt;
    }

    /**
     * @param \DateTime $ratedAt
     */
    public function setRatedAt($ratedAt)
    {
        $this->ratedAt = $ratedAt;
    }

    /**
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param string $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return boolean
     */
    public function getIsFavourite()
    {
        return $this->isFavourite;
    }

    /**
     * @param boolean $isFavourite
     */
    public function setIsFavourite($isFavourite)
    {
        $this->isFavourite = $isFavourite;
    }
}
