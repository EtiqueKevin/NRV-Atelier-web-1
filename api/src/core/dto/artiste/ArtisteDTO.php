<?php

namespace nrv\core\dto\artiste;

use nrv\core\dto\DTO;

class ArtisteDTO extends DTO {

    private string $id;
    private string $nom;

    private string $prenom;

    private string $description;

    public function __construct($artiste){
        $this->id = $artiste->ID;
        $this->nom = $artiste->nom;
        $this->prenom = $artiste->prenom;
        $this->description = $artiste->description;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'description' => $this->description,
            'link' => [
                'href' => 'artiste/'.$this->id,
            ]
        ];
    }

}