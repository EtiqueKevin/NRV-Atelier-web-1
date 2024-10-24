<?php

namespace nrv\core\services\authorization;

interface AuthzUtilisateurInterface
{
    function isGranted(string $user_id, int $operation, string $ressource_id): bool;
}