<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Controllers\GifsController;
use App\Services\GiphyGuzzleClient;
use App\Services\Contracts\HttpClientInterface;
use GuzzleHttp\Psr7\Response;

class GifsControllerTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        // Your construct here
    }
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
 
    /**
    * Testing the GET Route
    */
    public function testRoute()
    {
        $this->json('GET', '/api/v1/search/gif/sand')
             ->assertEquals(200, $this->response->status());
    }
    
    /**
    * Testing the Controller Search Function
    */
    public function testSearch()
    {
        $body = file_get_contents(__DIR__.'\Mocks\response.txt');
        $response = new Response($status = 200, $data = [$body]);
        $httpClient = Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('getSearchResults')->andReturn($data = [$body])->once();
        $search = 'sand';
        $gifsController = new GifsController($httpClient);
        $response = $gifsController->search($search);
        $this->assertEquals(200, $response->status());
    }
}
