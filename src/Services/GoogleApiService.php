<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Monolog\Logger;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class GoogleApiService
{
    public function __construct( public Logger $logger)
    {
        
    }
    
    public function getReviews(ServerRequestInterface $request)
    {

        $place_id = $_ENV['PLACE_ID'];
        $google_cloud_api_key = $_ENV['GOOGLE_CLOUD_API_KEY'];

        $client = new Client();
        $res = $client->request('GET', "https://maps.googleapis.com/maps/api/place/details/json?place_id={$place_id}&fields=reviews&key={$google_cloud_api_key}");

        $body = json_decode((string) $res->getBody(), true);
        if ($body['status'] !== "OK") {
            $this->logger->error($body['error_message']);
            throw new HttpBadRequestException($request,"Its not you! Something went wrong on our side");
        }


        return  $body['result']['reviews'];
    }
}
