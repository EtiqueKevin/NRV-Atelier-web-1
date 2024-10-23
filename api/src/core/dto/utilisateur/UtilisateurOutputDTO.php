<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurOutputDTO extends DTO{

    protected string $id;
    protected string $email;
    protected int $role;

    public function __construct($id,$email,$role){
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
    }

}