<?php

namespace nrv\core\dto\Panier;

use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class PanierItemDTO extends DTO
{
    protected string $id;
    protected string $idPanier;

    protected string $idSoiree;
    protected Soiree $soiree;
    protected int $tarif;
    protected string $typeTarif;
    protected int $qte;
    protected int $tarifTotal;


    /**
     * @param PanierItem $panierItem
     */
    public function __construct(PanierItem $panierItem)
    {
        $this->id = $panierItem->ID;
        $this->idSoiree = $panierItem->idSoiree;
        $this->soiree = $panierItem->soiree;
        $this->idPanier = $panierItem->idPanier;
        $this->tarif = $panierItem->tarif;
        $this->typeTarif = $panierItem->typeTarif;
        $this->tarifTotal = $panierItem->tarifTotal;
        $this->qte = $panierItem->qte;
    }


    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idPanier' => $this->idPanier,
            'idSoiree' => $this->idSoiree,
            'soiree' => $this->soiree->toDTO(),
            'tarif' => $this->tarif,
            'typeTarif' => $this->typeTarif,
            'tarifTotal' => $this->tarifTotal,
            'qte' => $this->qte
        ];
    }
}