<?php

namespace nrv\application\actions\utilisateur;

use nrv\application\actions\AbstractAction;
use nrv\application\providers\auth\AuthProviderInterface;
use nrv\core\services\utilisateur\UtilisateurException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpUnauthorizedException;

class RefreshAction extends AbstractAction
{
    private AuthProviderInterface $authProvider;

    public function __construct(AuthProviderInterface $authProvider) {
        $this->authProvider = $authProvider;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{

        try {
            $h = $rq->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, "erreur lors de la recuperation du token : ".$e->getMessage());
        }

        try {
            $authRes = $this->authProvider->refresh($tokenstring);
        }catch (UtilisateurException $e){
            throw new HttpUnauthorizedException($rq, 'Identifiants incorrects ' . $e->getMessage());
        }

        $response = [
            'type' => 'ressource',
            'atoken' => $authRes->accessToken,
        ];

        $rs->getBody()->write(json_encode($response));

        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}