<?php

namespace App\Service;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TMDBMovies
{


    public function __construct(private HttpClientInterface $tmdbClient)
    {

    }

    public function getMovies()
    {

        $response = $this->tmdbClient->request(
            'GET',
            'discover/movie'
        );


        if ($response->getStatusCode() == 200) {
            return $response->getContent();
        }

        throw new HttpException($response->getStatusCode());

    }


}