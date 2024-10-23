<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\dto\DTO;

class UtilisateurInputCreationSaveDTO extends DTO{

    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $mdp;
    public function __construct(string $nom,string $prenom,string $email,string $mdp, $role){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

}