<?php

namespace nrv\core\dto\Panier;

use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\dto\DTO;

class PanierItemDTO extends DTO
{
    protected string $id;
    protected string $idPanier;

    protected string $idSoiree;
    protected int $tarif;
    protected int $tatifTotal;
    protected int $qte;
    protected int $tarifTotal;

    public function __construct(PanierItem $panierItem)
    {
        $this->id = $panierItem->ID;
        $this->idSoiree = $panierItem->idSoiree;
        $this->idPanier = $panierItem->idPanier;
        $this->tarif = $panierItem->tarif;
        $this->tarifTotal = $panierItem->tarifTotal;
        $this->qte = $panierItem->qte;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idPanier' => $this->idPanier,
            'idSoiree' => $this->idSoiree,
            'tarif' => $this->tarif,
            'tarifTotal' => $this->tarifTotal,
            'qte' => $this->qte
        ];
    }
}