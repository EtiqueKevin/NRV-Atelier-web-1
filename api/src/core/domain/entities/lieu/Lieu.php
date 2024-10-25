<?php

namespace nrv\core\domain\entities\lieu;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\lieu\LieuDTO;
use nrv\core\dto\soiree\SoireeDTO;

class Lieu extends Entity{

    protected string $nom;

    protected string $adresse;
    protected int $places_assise;
    protected int $places_debout;

    /**
     * @param string $n
     * @param string $a
     * @param int $placesAssise
     * @param int $placesDebout
     */
    public function __construct(string $n, string $a, int $placesAssise, int $placesDebout){
        $this->nom = $n;
        $this->adresse = $a;
        $this->places_assise = $placesAssise;
        $this->places_debout = $placesDebout;
    }

    /**
     * TRANSFORME L'ENTITY EN DTO
     * @return LieuDTO
     */
    public function toDTO(): LieuDTO{
        return new LieuDTO($this);
    }
}