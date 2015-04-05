<?php

namespace Soliloquy\MovieBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Movie
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $originalTitle;

    /**
     * @MongoDB\String
     */
    protected $yearOfProduction;

    /**
     * @MongoDB\String
     */
    protected $englishTitle;

    /**
     * @MongoDB\String
     */
    protected $polishTitle;

    /**
     * @return string
     */
    public function getPolishTitle()
    {
        return $this->polishTitle;
    }

    /**
     * @param string $polishTitle
     */
    public function setPolishTitle($polishTitle)
    {
        $this->polishTitle = $polishTitle;
    }

    /**
     * @return string
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
    }

    /**
     * @return string
     */
    public function getYearOfProduction()
    {
        return $this->yearOfProduction;
    }

    /**
     * @param string $yearOfProduction
     */
    public function setYearOfProduction($yearOfProduction)
    {
        $this->yearOfProduction = $yearOfProduction;
    }

    /**
     * @return string
     */
    public function getEnglishTitle()
    {
        return $this->englishTitle;
    }

    /**
     * @param string $englishTitle
     */
    public function setEnglishTitle($englishTitle)
    {
        $this->englishTitle = $englishTitle;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
