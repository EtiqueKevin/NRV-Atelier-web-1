<?php
namespace nrv\application\providers\auth;

use nrv\core\dto\utilisateur\UtilisateurDTO;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\application\providers\auth\JWTManager;
use nrv\core\dto\utilisateur\UtilisateurRefreshDTO;
use nrv\core\services\utilisateur\UtilisateurServiceInterface;
use nrv\core\dto\utilisateur\UtilisateurOutputDTO;

class AuthProvider implements AuthProviderInterface{
    
    private UtilisateurServiceInterface $utiService;
    private JWTManager $jwtManager;

    public function __construct(UtilisateurServiceInterface $utiService, JWTManager $jwtManager){
        $this->utiService = $utiService;
        $this->jwtManager = $jwtManager;
    }

    public function signIn(UtilisateurInputDTO $credentials): UtilisateurDTO{
        try{
            // Verifier les credentials
            $utiDTO = $this->utiService->verifyCredentials($credentials);

            // Creer le payload pour les tokens
            $payload = [
                'iat'=>time(),
                'exp'=>time()+3600,
                'sub' => $utiDTO->id,
                'data' => [
                    'role' => $utiDTO->role,
                    'email' => $utiDTO->email,
                ]
            ];

            $accessToken = $this->jwtManager->createAccessToken($payload);
            $refreshToken = $this->jwtManager->createRefreshToken($payload);

            $utiDTO->setAccessToken($accessToken);
            $utiDTO->setRefreshToken($refreshToken);

            return $utiDTO;
        }catch(\Exception $e){
            throw new AuthProviderException("erreur auth");
        }
    }

    public function getSignIn(string $token): UtilisateurOutputDTO{
        $arrayToken = $this->jwtManager->decodeToken($token);
        $utiOutDTO = new UtilisateurOutputDTO($arrayToken['sub'],$arrayToken['data']->email,$arrayToken['data']->role);
        return $utiOutDTO;
    }

    public function refresh(string $token): UtilisateurRefreshDTO{
        // TODO a continuer
        return new UtilisateurRefreshDTO("");
    }
}