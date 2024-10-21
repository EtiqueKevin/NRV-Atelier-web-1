<?php
namespace nrv\application\providers\auth;

use nrv\core\dto\AuthDTO;
use nrv\core\dto\InputAuthDTO;

interface AuthProviderInterface{
    public function signIn(InputAuthDTO $credentials): AuthDTO;

    public function getSignIn(string $token): AuthDTO;
}