<?php

namespace Soliloquy\FilmwebBundle\Parser;

use Goutte\Client;

class FilmwebParser
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
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

        $crawler = $this->client->request('GET', $url);

        $movieUrl = $crawler->filter('div#searchResult ul.resultsList > li h3 a')->first()->attr('href');

        return 'http://www.filmweb.pl' . $movieUrl;
    }

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $crawler = $this->client->request('GET', 'https://ssl.filmweb.pl/login');
        $form = $crawler->selectButton('pass')->form();
        $this->client->submit($form, array('j_username' => $username, 'j_password' => $password));
    }

    public function logout()
    {
        $this->client->request('GET', 'http://filmweb.pl/logout');
    }

    /**
     * @param string $url
     *
     * @return array
     */
    public function parseMovieDetailsPage($url)
    {
        $crawler = $this->client->request('GET', $url);

        $polishTitleElement = $crawler->filter('h1.filmTitle a')->first();
        $polishTitle = count($polishTitleElement) ? $polishTitleElement->text() : null;

        $originalTitleElement = $crawler->filter('div.filmMainHeader h2')->first();
        $originalTitle = count($originalTitleElement) ? $originalTitleElement->text() : $polishTitle;

        $ratingElement = $crawler->filter('div.ratingInfo span[property="v:average"]')->first();
        $rating = count($ratingElement) ? $ratingElement->text() : null;

        $yearOfProductionElement = $crawler->filter('div.filmMainHeader div.hdr span.halfSize')->first();
        if (count($yearOfProductionElement)) {
            preg_match('/\((.*?)\)/', $yearOfProductionElement->text(), $matches);
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

    /**
     * @return array
     */
    public function parseUserMoviesListPage()
    {
        $url = 'http://www.filmweb.pl/data/myFilmVotes';

        $response = $this->client->getClient()->get(
            $url,
            array('cookies' => $this->client->getCookieJar()->allRawValues($url))
        );

        $body = $response->getBody()->read($response->getHeader('Content-Length'));

        $movies = $this->parseUserMoviesListBody($body);

        return $movies;
    }

    protected function parseUserMoviesListBody($body)
    {
        $lines = explode('\a', $body);

        unset($lines[0]);

        $movies = array();
        foreach ($lines as $line) {
            $data = explode('\c', $line);
            $movies[] = array (
                'id' => $data[0],
                'rating' => $data[1],
                'isFavourite' => $data[2] ? true : false,
                'ratedAt' => new \DateTime($data[3]),
            );
        }

        return $movies;
    }
}
