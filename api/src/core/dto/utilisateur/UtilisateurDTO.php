<?php

namespace nrv\core\dto\utilisateur;

use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\DTO;

class UtilisateurDTO extends DTO{

    protected string $id;
    protected string $nom;

    protected string $prenom;

    protected string $email;

    protected string $mdp;

    protected int $role;

    public function __construct(Utilisateur $uti){
        $this->nom = $uti->nom;
        $this->prenom = $uti->prenom;
        $this->email = $uti->email;
        $this->mdp = $uti->mdp;
        $this->role = $uti->role;
        $this->id = $uti->ID;
    }

    public function jsonSerialize(): array{
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'role' => $this->role,
        ];
    }


}