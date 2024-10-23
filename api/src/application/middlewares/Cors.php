<?php

namespace nrv\application\middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;

class Cors{

    private $allowedOrigins = [
        'http://localhost:35611',
        'http://docketu.iutnc.univ-lorraine.fr:35611',
        'http://localhost:35610',
    ];

    public function __invoke(ServerRequestInterface $rq, RequestHandlerInterface $next): ResponseInterface {
        if (!$rq->hasHeader('Origin')) {
            throw new HttpUnauthorizedException($rq, "missing Origin Header (cors)");
        }

        $origin = $rq->getHeaderLine('Origin');
        if (!in_array($origin, $this->allowedOrigins)) {
            throw new HttpUnauthorizedException($rq, "Origin not allowed (cors)");
        }

        $response = $next->handle($rq);
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Methods', 'POST, PUT, GET, PATCH')
            ->withHeader('Access-Control-Allow-Headers', 'Authorization, Content-Type')
            ->withHeader('Access-Control-Max-Age', 3600)
            ->withHeader('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}