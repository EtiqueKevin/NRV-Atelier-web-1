<?php

namespace nrv\core\dto\Panier;

use nrv\core\dto\DTO;

class PanierAddDTO extends DTO
{
    protected string $idUser;
    protected string $idSoiree;
    protected int $tarif;
    protected string $typeTarif;
    protected int $qte;

    public function __construct(string $idUser, string $idSoiree,int $tarif, string $typeTarif, int $qte)
    {
        $this->idUser = $idUser;
        $this->idSoiree = $idSoiree;
        $this->tarif = $tarif;
        $this->typeTarif = $typeTarif;
        $this->qte = $qte;
    }
}