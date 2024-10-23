<?php

namespace nrv\core\domain\entities\Panier;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\Panier\PanierItemDTO;

class PanierItem extends Entity
{
    protected string $idSoiree;
    protected string $idPanier;
    protected int $tarif;
    protected int $tatifTotal;
    protected int $qte;

    public function __construct(string $idSoiree, $idPanier, int $tarif, int $tatifTotal, int $qte)
    {
        $this->idSoiree = $idSoiree;
        $this->idPanier = $idPanier;
        $this->tarif = $tarif;
        $this->tatifTotal = $tatifTotal;
        $this->qte = $qte;
    }

    public function toDTO(): PanierItemDTO
    {
        return new PanierItemDTO($this);
    }
}