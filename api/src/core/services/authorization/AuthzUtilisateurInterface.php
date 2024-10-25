<?php

namespace nrv\core\services\authorization;

interface AuthzUtilisateurInterface
{

    /**
     * VERIFIE LES DROITS D'UN UTILISATEUR
     * @param int $role
     * @return int
     */
    function isGranted(int $role): int;
}