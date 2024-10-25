<?php

namespace nrv\core\dto\Panier;

use nrv\core\dto\DTO;

class PanierModifierDTO extends DTO
{
    protected string $idUser;
    protected string $idSoiree;
    protected int $qte;

    public function __construct(string $idUser, string $idSoiree, int $qte)
    {
        $this->idUser = $idUser;
        $this->idSoiree = $idSoiree;
        $this->qte = $qte;
    }
}