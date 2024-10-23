<?php

namespace nrv\core\dto\soiree;

use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\dto\DTO;

class LieuDTO extends DTO
{
    private string $id;
    private string $nom;
    private string $adresse;
    private int $places_assise;
    private int $places_debout;

    public function __construct(Lieu $lieu)
    {
        $this->id = $lieu->ID;
        $this->nom = $lieu->nom;
        $this->adresse = $lieu->adresse;
        $this->places_assise = $lieu->places_assise;
        $this->places_debout = $lieu->places_debout;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'adresse' => $this->adresse,
            'places_assise' => $this->places_assise,
            'places_debout' => $this->places_debout
        ];
    }
}