<?php

namespace nrv\core\domain\entities\soiree;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\soiree\LieuDTO;
use nrv\core\dto\soiree\SoireeDTO;

class Lieu extends Entity{

    protected string $nom;

    protected string $adresse;
    protected int $places_assise;
    protected int $places_debout;

    public function __construct(string $n, string $a, int $placesAssise, int $placesDebout){
        $this->nom = $n;
        $this->adresse = $a;
        $this->places_assise = $placesAssise;
        $this->places_debout = $placesDebout;
    }

    public function toDTO(): LieuDTO{
        return new LieuDTO($this);
    }
}