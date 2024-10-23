<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurRefreshDTO extends DTO{

    protected string $accessToken;

    public function __construct(string $at){
        $this->accessToken = $at;
    }

}