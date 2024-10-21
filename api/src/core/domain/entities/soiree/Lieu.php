<?php

namespace nrv\core\domain\entities\soiree;

use nrv\core\domain\entities\Entity;

class Lieu extends Entity{
    protected string $titre;
    protected string $adresse;
    protected int $places_assises;
    protected int $places_debout;

    public function construct(){

    }


}