<?php

namespace Soliloquy\MovieBundle\Document;

class MovieProxy
{
    /**
     * @var Movie
     */
    protected $movie;

    /**
     * @var \DateTime
     */
    protected $ratedAt;

    /**
     * @var string
     */
    protected $rate;

    /**
     * @var boolean
     */
    protected $isFavourite;

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
