<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\GoogleApiService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GoogleApiController

{
    public function __construct(public GoogleApiService $apiService){
    
    }

    public function getReviews(Request $request, Response $response)
    {

        $data = $this->apiService->getReviews($request);
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(200);
    }
}
