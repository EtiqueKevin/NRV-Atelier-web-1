<?php

namespace nrv\core\services\authorization;

use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class AuthorizationService implements AuthzUtilisateurInterface
{
    private UtilisateursRepositoryInterface $utilisateursRepository;

    public function __construct( $utilisateursRepository)
    {
        $this->utilisateursRepository = $utilisateursRepository;
    }

    function isGranted(string $user_id, int $operation, string $ressource_id): int
    {
        //on cherche le role de l'utilisateur
        $role = $this->utilisateursRepository->getRole($user_id);

        if ($role >= 1) {
            return 2;
        } elseif ($role == 0) {
            return 1;
        } else {
            return 0;
        }
    }
}