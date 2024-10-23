<?php
namespace nrv\application\providers\auth;

use nrv\core\dto\utilisateur\UtilisateurDTO;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\core\dto\utilisateur\UtilisateurOutputDTO;
use nrv\core\dto\utilisateur\UtilisateurRefreshDTO;

interface AuthProviderInterface{
    public function signIn(UtilisateurInputDTO $credentials): UtilisateurDTO;

    public function getSignIn(string $token): UtilisateurOutputDTO;

    public function refresh(string $token):UtilisateurRefreshDTO;
}