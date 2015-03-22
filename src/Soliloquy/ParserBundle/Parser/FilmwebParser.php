<?php

namespace Soliloquy\ParserBundle\Parser;

class FilmwebParser
{
    /**
     * @var Sunra\PhpSimple\HtmlDomParser
     */
    protected $parser;

    /**
     * @param Sunra\PhpSimple\HtmlDomParser $parser
     */
    public function __construct($parser)
    {
        $this->parser = $parser;
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
     * @return array
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

        $details = array(
            'polishTitle' => $polishTitle,
            'originalTitle' => $originalTitle,
            'rating' => $rating,
            'yearOfProduction' => $yearOfProduction,
        );

        return $details;
    }
}
