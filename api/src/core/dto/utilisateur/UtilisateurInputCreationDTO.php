<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurInputCreationDTO extends DTO{

    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $mdp;
    protected string $mdp2;

    public function __construct(string $nom,string $prenom,string $email,string $mdp,string $mdp2){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->mdp2 = $mdp2;
    }

}