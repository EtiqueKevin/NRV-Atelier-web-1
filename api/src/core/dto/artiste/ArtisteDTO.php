<?php

namespace nrv\core\dto\artiste;

use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\dto\DTO;

class ArtisteDTO extends DTO {

    private string $id;
    private string $nom;

    private string $prenom;

    private string $description;


    /**
     * @param Artiste $artiste
     */
    public function __construct(Artiste $artiste){
        $this->id = $artiste->ID;
        $this->nom = $artiste->nom;
        $this->prenom = $artiste->prenom;
        $this->description = $artiste->description;
    }

    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'description' => $this->description,
        ];
    }

}