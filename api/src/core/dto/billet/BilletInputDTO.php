<?php

namespace nrv\core\dto\billet;

use DateTime;
use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\DTO;

class BilletInputDTO extends DTO{

    protected string $idBillet;
    protected string $id_utilisateur;

    public function __construct(string $idB, string $uti){
        $this->idBillet = $idB;
        $this->id_utilisateur = $uti;
    }

    public function jsonSerialize(): array{

        $tab = [];

        foreach ($this->billets as $b){
            $tab[] = $b->toDTO();
        }

        return
            $tab;

    }

}