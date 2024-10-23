<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurInputDTO extends DTO{

    protected string $email;
    protected string $mdp;

    public function __construct(string $email,string $mdp){
        $this->email = $email;
        $this->mdp = $mdp;
    }

}