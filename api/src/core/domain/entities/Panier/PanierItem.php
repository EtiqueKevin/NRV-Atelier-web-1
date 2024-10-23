<?php

namespace nrv\core\domain\entities\Panier;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\Panier\PanierItemDTO;

class PanierItem extends Entity
{
    protected string $idSoiree;
    protected string $idPanier;
    protected int $tarif;

    protected int $tarifTotal;
    protected int $qte;

    public function __construct(string $idSoiree, $idPanier, int $tarif, int $tarifTotal, int $qte)
    {
        $this->idSoiree = $idSoiree;
        $this->idPanier = $idPanier;
        $this->tarif = $tarif;
        $this->tarifTotal = $tarifTotal;
        $this->qte = $qte;
    }

    public function toDTO(): PanierItemDTO
    {
        return new PanierItemDTO($this);
    }
}