<?php

namespace nrv\core\services\authorization;

interface AuthzUtilisateurInterface
{
    function isGranted(int $role): int;
}