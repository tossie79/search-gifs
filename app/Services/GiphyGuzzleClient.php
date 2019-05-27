<?php
declare(strict_types=1);
namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Services\Contracts\HttpClientInterface;

// use \Config;

class GiphyGuzzleClient implements HttpClientInterface
{
    private $client;
    private $apiKey;
    private $connectionUrl;
    public function __construct()
    {
        $this->client = new Client();
        // $this->connectionUrl=config('services.giphy.url');
        // $this->apiKey=config('services.giphy.key');
    }

    public function createConnection()
    {
    }
    public function getConnectionUrl()
    {
        $this->connectionUrl = config('services.giphy.url');
        return  $this->connectionUrl;
    }
    public function getData(string $query)
    {
        $response = $this->client->request(
            'GET',
            "{$this->getConnectionUrl()}",
            [
                'query' => [
                    "q" => "$query",
                    "api_key"=>"{$this->getApiKey()}",
                    "limit"=>"1"
                ]
            ]
        );
        
        $results= $response->getBody()->getContents();
        $results=json_decode($results, true);
        $gif=$results['data'][0];
        $status=$response->getStatusCode();
        $message=$response->getReasonPhrase(); 
        $gifArray = [
            'status'=>$status,
            'message'=>$message,
            'details'=>$gif
        ];
        return $gifArray;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getApiKey()
    {
        $this->apiKey = config('services.giphy.key');
        return  $this->apiKey;
    }
}
