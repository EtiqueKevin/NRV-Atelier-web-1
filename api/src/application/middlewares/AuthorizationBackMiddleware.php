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

    /**
     * @param AuthzUtilisateurInterface $authServInter
     */
    public function __construct( AuthzUtilisateurInterface $authServInter){
        $this->authServInter = $authServInter;
    }

    /**
     * VERIFIE LES AUTORISATIONS DE L'UTILISATEUR POUR LE BACK OFFICE
     * @param ServerRequestInterface $rq
     * @param RequestHandlerInterface $next
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, RequestHandlerInterface $next): ResponseInterface{
        $routeContext = RouteContext::fromRequest($rq);
        $route = $routeContext->getRoute();

        $idUser = $rq->getAttribute('UtiOutDTO')->id;
        $role = $rq->getAttribute('UtiOutDTO')->role;

        if($this->authServInter->isGranted($role) == 2){
            return $next->handle($rq);
        }else{
            throw new HttpForbiddenException($rq, 'Vous n\'avez pas les droits pour effectuer cette action');
        }
    }

}