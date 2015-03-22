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
     * @param array $parameters
     *
     * @return string
     */
    public function findMovieUrl($parameters)
    {
        $url = 'http://www.filmweb.pl/search/film?q=' . urlencode($parameters['title']);

        if (!empty($parameters['year'])) {
            $url .= '&startYear=' . $parameters['year'] . '&endYear=' . $parameters['year'];
        }

        $dom = $this->parser->file_get_html($url);

        $movieUrl = $dom->find('div#searchResult ul.resultsList > li h3 a', 0)->href;

        return 'http://www.filmweb.pl' . $movieUrl;
    }

    /**
     * @param string $url
     *
     * @return Soliloquy\MovieBundle\Document\Movie
     */
    public function parseMovieDetailsPage($url)
    {
        $dom = $this->parser->file_get_html($url);

        $polishTitleElement = $dom->find('h1.filmTitle a', 0);
        $polishTitle = !empty($polishTitleElement) ? $polishTitleElement->innertext : null;

        $originalTitleElement = $dom->find('div.filmMainHeader h2', 0);
        $originalTitle = !empty($originalTitleElement) ? $originalTitleElement->innertext : $polishTitle;

        $ratingElement = $dom->find('div.ratingInfo span[property="v:average"]', 0);
        $rating = !empty($ratingElement) ? $ratingElement->innertext : null;

        $yearOfProductionElement = $dom->find('div.filmMainHeader div.hdr span.halfSize', 0);
        if (!empty($yearOfProductionElement)) {
            preg_match('/\((.*?)\)/', $yearOfProductionElement->innertext, $matches);
            $yearOfProduction = $matches[1];
        }

        $this->movie->setPolishTitle($polishTitle);
        $this->movie->setOriginalTitle($originalTitle);
        $this->movie->setRating($rating);
        $this->movie->setYearOfProduction($yearOfProduction);

        return $this->movie;
    }
}
