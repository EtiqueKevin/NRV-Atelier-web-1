<?php

namespace nrv\application\middlewares;

use nrv\core\services\authorization\AuthzUtilisateurInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;
use Slim\Exception\HttpForbiddenException;
use Slim\Routing\RouteContext;

class AuthorizationBackMiddleware{

    protected AuthzUtilisateurInterface $authServInter;

    public function __construct( AuthzUtilisateurInterface $authServInter){
        $this->authServInter = $authServInter;
    }

    public function __invoke(ServerRequestInterface $rq, RequestHandlerInterface $next): ResponseInterface{
        $routeContext = RouteContext::fromRequest($rq);
        $route = $routeContext->getRoute();

        $user_id = $rq->getAttribute('user_id'); // ou getArgument
        $operation = $route->getArgument('operation');

        if($this->authServInter->isGranted($user_id, $operation) == 2){
            return $next->handle($rq);
        }else{
            throw new HttpForbiddenException($rq, 'Vous n\'avez pas les droits pour effectuer cette action');
        }
    }

}