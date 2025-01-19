<?php

declare(strict_types=1);

namespace App\Middlewares;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class ResponseMiddleware
{
    public function __invoke(Request $req, Handler $handler):Response {
        $response= $handler->handle($req);
        return $response->withHeader("Content-Type", 'application/json');
    }
}
