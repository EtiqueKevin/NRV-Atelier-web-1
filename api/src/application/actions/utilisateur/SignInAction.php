<?php

namespace nrv\application\actions\utilisateur;

use nrv\application\actions\AbstractAction;
use nrv\application\providers\auth\AuthProviderInterface;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\core\services\utilisateur\UtilisateurException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class SignInAction extends AbstractAction
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
        $encodedCredentials = $authHeaderTab[1];
        $decodedCredentials = base64_decode($encodedCredentials);
        $credentials = explode(':', $decodedCredentials);

        $email = $credentials[0];
        $mdp = $credentials[1];
        try {
            $authRes = $this->authProvider->signIn(new UtilisateurInputDTO($email, $mdp));
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