<?php

namespace nrv\core\services\authorization;

use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class AuthorizationService implements AuthzUtilisateurInterface
{

    public function __construct()
    {
    }

    /**
     * VERIFIE LES DROITS D'UN UTILISATEUR
     * @param int $role
     * @return int
     */
    function isGranted(int $role): int
    {
        if ($role >= 1) {
            return 2;
        } elseif ($role == 0) {
            return 1;
        } else {
            return 0;
        }
    }
}