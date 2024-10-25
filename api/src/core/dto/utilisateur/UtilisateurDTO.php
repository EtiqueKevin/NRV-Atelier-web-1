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
    protected ?string $accessToken;
    protected ?string $refreshToken;

    /**
     * @param Utilisateur $uti
     */
    public function __construct(Utilisateur $uti){
        $this->nom = $uti->nom;
        $this->prenom = $uti->prenom;
        $this->email = $uti->email;
        $this->mdp = $uti->mdp;
        $this->role = $uti->role;
        $this->id = $uti->ID;
    }


    /**
     * SETTER DE L'ACCESS TOKEN
     * @param string $actoken
     * @return void
     */
    public function setAccessToken(string $actoken){
        $this->accessToken = $actoken;
    }


    /**
     * SETTER DU REFRESH TOKEN
     * @param string $retoken
     * @return void
     */
    public function setRefreshToken(string $retoken){
        $this->refreshToken = $retoken;
    }


    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
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