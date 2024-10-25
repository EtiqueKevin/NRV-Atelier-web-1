<?php

namespace nrv\core\dto\Panier;

use nrv\core\domain\entities\Panier\Panier;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class PanierInputDTO extends DTO{
    protected string $idPanier;
    protected string $idSoiree;


    /**
     * @param string $idP
     * @param string $idS
     */
    public function __construct(string $idP, string $idS){
        $this->idPanier = $idP;
        $this->idSoiree = $idS;
    }

}