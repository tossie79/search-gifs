<?php
declare(strict_types=1);
namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Services\Contracts\HttpClientInterface;

class GiphyGuzzleClient implements HttpClientInterface
{
    /**
    * Class Variables
    * @var HttpClient
    *
    */
    private $client;
    /**
    * Class Variables
    * @var string
    *
    */
    private $apiKey;
    /**
    * Class Variables
    * @var string
    *
    */
    private $connectionUrl;
    /**
    * Create a new HttpClient instance, set the giphy url and api key
    * @return void
    */
    public function __construct()
    {
        $this->client = new Client();
        $this->connectionUrl = config('services.giphy.url');
        $this->apiKey = config('services.giphy.key');
    }
    
    /**
    * Return the giphy api url
    * @return string
    */
    public function getConnectionUrl():string
    {
        return  $this->connectionUrl;
    }

    /**
    * return HttpClient instance
    * @return httpClient
    */
    public function getClient():Client
    {
        return $this->client;
    }

    /**
    * returns the  api key
    * @return string
    */
    public function getApiKey():string
    {
        return  $this->apiKey;
    }

    /**
    * Get Request that fetches the results from GIPHY
    * @param string
    * @return array
    */
    public function getSearchResults(string $search):array
    {
        $response = $this->getClient()->request(
            'GET',
            "{$this->getConnectionUrl()}",
            [
                'query' => [
                    "q" => "{$search}",
                    "api_key"=>"{$this->getApiKey()}"
                ]
            ]
        );
        
        $results = $response->getBody()->getContents();
        $results = json_decode($results, true);
        $results=$results['data'];
        $status = $response->getStatusCode();
        $message = $response->getReasonPhrase();
        $giphyArray =
        [
            'status'=>$status,
            'message'=>$message,
            'data'=>$results
        ];
        return $giphyArray;
    }
}
