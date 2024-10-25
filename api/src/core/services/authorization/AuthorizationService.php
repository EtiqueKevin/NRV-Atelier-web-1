<?php

namespace nrv\core\services\authorization;

use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class AuthorizationService implements AuthzUtilisateurInterface
{
    private UtilisateursRepositoryInterface $utilisateursRepository;

    public function __construct( $utilisateursRepository)
    {
    }

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