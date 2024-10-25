<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurOutputDTO extends DTO{

    protected string $id;
    protected string $email;
    protected int $role;


    /**
     * @param string $id
     * @param string $email
     * @param int $role
     */
    public function __construct(string $id,string $email,int $role){
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
    }

}