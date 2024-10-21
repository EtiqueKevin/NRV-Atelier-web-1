<?php

namespace nrv\core\domain\entities\soiree;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\soiree\SoireeDTO;

class Lieu extends Entity{

    protected string $titre;

    protected string $adresse;
    protected int $places_assise;
    protected int $places_debout;

    public function construct(string $t, string $a, int $placesAssise, int $placesDebout){
        $this->titre = $t;
        $this->adresse = $a;
        $this->places_assise = $placesAssise;
        $this->places_debout = $placesDebout;
    }
}