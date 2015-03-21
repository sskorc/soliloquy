<?php

namespace Soliloquy\ParserBundle\Parser;

class FilmwebParser
{
    /**
     * @var Sunra\PhpSimple\HtmlDomParser
     */
    protected $parser;

    /**
     * @var Soliloquy\MovieBundle\Document\Movie
     */
    protected $movie;

    /**
     * @param Sunra\PhpSimple\HtmlDomParser $parser
     */
    public function __construct($parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param Soliloquy\MovieBundle\Document\Movie $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

    /**
     * @param string $url
     *
     * @return Soliloquy\MovieBundle\Document\Movie
     */
    public function parseMovieDetailsPage($url)
    {
        $dom = $this->parser->file_get_html($url);

        $polishTitle = $dom->find('h1.filmTitle a', 0)->innertext;
        $originalTitle = $dom->find('div.filmMainHeader h2', 0)->innertext;
        $rating = $dom->find('div.ratingInfo span[property="v:average"]', 0)->innertext;

        $this->movie->setPolishTitle($polishTitle);
        $this->movie->setOriginalTitle($originalTitle);

        return $this->movie;
    }
}
