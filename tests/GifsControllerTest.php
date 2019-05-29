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
 

    public function testRoute()
    {
        $this->json('GET', '/api/v1/search/gif/banana')
             ->assertEquals(200, $this->response->status());
    }

    public function testSearch()
    {
        $httpClient = Mockery::mock(HttpClientInterface::class);
        $httpClient->shouldReceive('getSearchResults')
            ->andReturn(
                $data=[
                    'status'=>'200',
                    'message'=>'OK',
                    'data'=>[]
                ]
        )->once();
        $search = 'banana';
        //$this->app->instance(HttpClientInterface::class, $httpClient);
        $gifsController = new GifsController($httpClient);
        
        $response = $gifsController->search($search);
        // dd($response);
        // $this->assertTrue(is_int($response));
        // $this->assertEquals(200, $response['statusCode']);
        // $this->seeJsonStructure(
        //     [   "status",
        //         "message",
        //         "data"
        //     ]
        // );
    }
    // public function testSearch()
    // {
    //     $mock = Mockery::mock(HttpClientInterface::class);
    //     $mock->shouldReceive('getSearchResults')->with('banana');

    //     $this->app->instance(HttpClientInterface::class, $mock);
    //     $repo = $this->app->make(GifsController::class);
    //     $result = $repo->search('banana');
    //     dd($result->getBody());
    //     $js=json_decode($result);
    // }

    // public function testMyRoute()
    // {
    //     $response = new Response([444]);
    //     $client = Mockery::mock(HttpClientInterface::class)
    //                  ->makePartial()
    //                  ->shouldReceive('getSearchResults')
    //                  ->once()
    //                  ->andReturn($response);
    //     $this->app->instance(HttpClientInterface::class, $client);

    //     $this->json('get', '/')->seeJson([ 'status' => 444 ]);
    // }
}
