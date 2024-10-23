<?php

namespace nrv\core\dto\Panier;

use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\dto\DTO;

class PanierItemDTO extends DTO
{
    private string $id;
    private string $idPanier;
    private string $idSoiree;
    private int $tarif;
    private int $tatifTotal;
    private int $qte;

    public function __construct(PanierItem $panierItem)
    {
        $this->id = $panierItem->ID;
        $this->idSoiree = $panierItem->idSoiree;
        $this->idPanier = $panierItem->idPanier;
        $this->tarif = $panierItem->tarif;
        $this->tatifTotal = $panierItem->tatifTotal;
        $this->qte = $panierItem->qte;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idPanier' => $this->idPanier,
            'idSoiree' => $this->idSoiree,
            'tarif' => $this->tarif,
            'tatifTotal' => $this->tatifTotal,
            'qte' => $this->qte
        ];
    }
}