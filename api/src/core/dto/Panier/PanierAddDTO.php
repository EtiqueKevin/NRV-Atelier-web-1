<?php

namespace nrv\core\dto\Panier;

use nrv\core\dto\DTO;

class PanierAddDTO extends DTO
{
    protected string $idUser;
    protected string $idSoiree;
    protected ?int $tarif;
    protected string $typeTarif;
    protected int $qte;

    public function __construct(string $idUser, string $idSoiree, string $typeTarif, int $qte)
    {
        $this->idUser = $idUser;
        $this->idSoiree = $idSoiree;
        $this->typeTarif = $typeTarif;
        $this->qte = $qte;
    }

    public function setTarif(int $tarif): void
    {
        $this->tarif = $tarif;
    }
}