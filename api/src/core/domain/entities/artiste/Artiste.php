<?php

namespace nrv\core\domain\entities\artiste;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\artiste\ArtisteDTO;

class Artiste extends Entity {

    protected string $nom;

    protected string $prenom;

    protected string $description;

    public function __construct(string $n, string $p, string $desc){
        $this->nom = $n;
        $this->prenom = $p;
        $this->description = $desc;
    }

    public function toDTO(){
        return new ArtisteDTO($this);
    }

}