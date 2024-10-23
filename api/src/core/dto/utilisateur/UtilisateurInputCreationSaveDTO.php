<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurInputCreationSaveDTO extends DTO{

    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $mdp;
    protected string $role;
    public function __construct($nom,$prenom,$email,$mdp,$role){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

}