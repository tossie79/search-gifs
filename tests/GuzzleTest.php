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

    /**
    * Testing the Guzzle Http Client
    */
    public function testHttpClient()
    {
        $body = file_get_contents(__DIR__.'\Mocks\response.txt');
        $response = new Response($status = 200, $data = [$body]);
        $mock =  Mockery::mock(Client::class);
        $mock->shouldReceive('request')->with('sand')->andReturn($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("OK", $response->getReasonPhrase());
    }
}
