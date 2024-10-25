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


    /**
     * @param string $n
     * @param string $p
     * @param string $email
     * @param string $mdp
     * @param int $role
     */
    public function __construct(string $n, string $p, string $email, string $mdp, int $role){
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->role = $role;
    }


    /**
     * TRANSFORME L'ENTITY EN DTO
     * @return UtilisateurDTO
     */
    public function toDTO(){
        return new UtilisateurDTO($this);
    }
}