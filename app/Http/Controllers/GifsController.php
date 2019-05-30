<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Contracts\HttpClientInterface;

class GifsController extends Controller
{
    /***
    * @var httpClient
    */
    private $httpClient;
    
    /**
    * Create a new controller instance
    * @param HttpClientInterface
    * @return void
    */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    
    /**
    * Search For a Gif with the search string given
    * @param string
    * @return Response
    */
    public function search($search)
    {
        if (!empty($search)) {
            $results=$this->httpClient->getSearchResults($search);
            return response()->json($results);
        }

        $error = ['error'=>[
            'status'=>'Error',
            'message'=> 'Error: Please enter a search term.',
            ]
        ];
        return response()->json($error);
    }
}
