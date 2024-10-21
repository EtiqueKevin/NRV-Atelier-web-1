<?php

namespace nrv\core\domain\entities\artiste;

use nrv\core\domain\entities\Entity;

class Artiste extends Entity {

    protected string $nom;

    protected string $prenom;

    protected string $description;

    public function construct(string $n, string $p, string $desc){
        $this->nom = $n;
        $this->prenom = $p;
        $this->description = $desc;
    }
}