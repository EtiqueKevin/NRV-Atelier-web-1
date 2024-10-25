<?php

namespace nrv\core\dto\billet;

use DateTime;
use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\DTO;

class BilletInputDTO extends DTO{

    protected string $idBillet;
    protected string $id_utilisateur;

    /**
     * @param string $idB
     * @param string $uti
     */
    public function __construct(string $idB, string $uti){
        $this->idBillet = $idB;
        $this->id_utilisateur = $uti;
    }

    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array{

        $tab = [];

        foreach ($this->billets as $b){
            $tab[] = $b->toDTO();
        }

        return
            $tab;

    }

}