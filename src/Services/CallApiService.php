<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class CallApiService{


    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }



    public function getDataTunisia():array
    {


        $response = $this->client->request(
            'GET',
            'https://coronavirus-19-api.herokuapp.com/countries/tunisia'
        );
        return $response->toArray();

    }


    public function getDataWorld():array
    {


        $response = $this->client->request(
            'GET',
            'https://coronavirus-19-api.herokuapp.com/all'
        );
        return $response->toArray();

    }



}