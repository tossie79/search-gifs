<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Contracts\HttpClientInterface;

class GifsController extends Controller
{
    private $httpClient;
    
    /**
    * Create a new controller instance
    *
    * @return void
    */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function index($search)
    {
        if (!empty($search)) {
            $gif=$this->httpClient->getData($search);
           return response()->json(['data'=>$gif]);
          
            
        }
    }
}
