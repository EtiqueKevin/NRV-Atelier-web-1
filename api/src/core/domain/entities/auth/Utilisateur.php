<?php

namespace nrv\core\domain\entities\auth;

use nrv\core\domain\entities\Entity;

class Utilisateur extends Entity{

    protected string $nom;

    protected string $prenom;

    protected string $email;

    protected string $mdp;

    protected bool $admin;

    public function __construct(string $n, string $p, string $email, string $mdp, bool $admin){
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->admin = $admin;
    }
}