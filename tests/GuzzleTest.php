<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Services\GiphyGuzzleClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GuzzleTest extends TestCase
{
    protected $client;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
 
    public function testHttpClient()
    {
        $mock =  Mockery::mock(Client::class);
        $mock->shouldReceive('request')->andReturn(new Response(
            $status = 200,
            $data=[
            'status'=>'200',
            'message'=>'OK',
            'data'=>[]
        ]
        ));
        $this->assertEquals(200, $this->response->status());
    }

    // public function testRoute()
    // {
    //     $jsonObject = json_encode(['foo']);
    //     $uri = 'http://api.giphy.com/v1/gifs/search';

    //     $mockResponse = $this->getMockBuilder(Response::class)->getMock();

    //     $mockResponse->method('getBody')->willReturn($jsonObject);

    //     $clientMock = $this->getMockBuilder(Client::class)->getMock();

    //     $clientMock->expects($this->once())
    //         ->method('request')
    //         ->with(
    //             'GET',
    //             $uri,
    //             ['q'=>'banana']
    //         )
    //         ->willReturn($mockResponse);

    //     //$result = $yourClass->get($uri);

    //     $expected = json_decode($jsonObject);

    //     //$this->assertSame($expected, $result);
    // }
}
