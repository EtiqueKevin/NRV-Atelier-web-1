<?php

namespace nrv\application\actions;

use Firebase\JWT\JWT;
use nrv\application\actions\AbstractAction;
use nrv\application\providers\auth\AuthProviderInterface;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\core\dto\utilisateur\UtilisateurOutputDTO;
use nrv\core\services\utilisateur\UtilisateurException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;
class RefreshAction extends AbstractAction
{
    private AuthProviderInterface $authProvider;

    public function __construct(AuthProviderInterface $authProvider) {
        $this->authProvider = $authProvider;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $authHeader = $rq->getHeaderLine('Authorization');
        $authHeaderTab = explode(' ', $authHeader);
        if ($authHeaderTab[0] !== 'Basic') {
            throw new HttpUnauthorizedException($rq, 'Authorization header absent ou mal formé');
        }

        try {
            $authRes = $this->authProvider->refresh();
        }catch (UtilisateurException $e){
            throw new HttpUnauthorizedException($rq, 'Identifiants incorrects ' . $e->getMessage());
        }

        $response = [
            'type' => 'ressource',
            'atoken' => $authRes->accessToken,
            'rtoken' => $authRes->refreshToken
        ];

        $rs->getBody()->write(json_encode($response));

        return $rs->withHeader('Content-Type', 'application/json');
    }
}