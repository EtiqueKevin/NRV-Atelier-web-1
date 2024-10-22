<?php

namespace nrv\core\domain\entities\utilisateur;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\utilisateur\UtilisateurDTO;

class Utilisateur extends Entity{

    protected string $nom;

    protected string $prenom;

    protected string $email;

    protected string $mdp;

    protected int $role;

    public function __construct(string $n, string $p, string $email, string $mdp, int $role){
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->role = $role;
    }

    public function toDTO(){
        return new UtilisateurDTO($this);
    }
}