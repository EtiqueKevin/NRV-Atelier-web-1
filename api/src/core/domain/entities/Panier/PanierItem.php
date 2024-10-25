<?php

namespace nrv\core\domain\entities\Panier;

use nrv\core\domain\entities\Entity;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\Panier\PanierItemDTO;

class PanierItem extends Entity
{
    protected string $idSoiree;
    protected Soiree $soiree;
    protected string $idPanier;
    protected int $tarif;
    protected string $typeTarif;
    protected int $tarifTotal;
    protected int $qte;

    /**
     * @param string $idSoiree
     * @param $idPanier
     * @param int $tarif
     * @param string $typeTarif
     * @param int $tarifTotal
     * @param int $qte
     */
    public function __construct(string $idSoiree, $idPanier, int $tarif,string $typeTarif, int $tarifTotal, int $qte)
    {
        $this->idSoiree = $idSoiree;
        $this->idPanier = $idPanier;
        $this->tarif = $tarif;
        $this->typeTarif = $typeTarif;
        $this->tarifTotal = $tarifTotal;
        $this->qte = $qte;
    }

    /**
     * SETTER DE LA QUANTITE DE L'ITEM DU PANIER
     * @param int $qte
     * @return void
     */
    public function setQte(int $qte) {
        $this->qte = $qte;
    }


    /**
     * SETTER DE LA SOIREE DE L'ITEM DU PANIER
     * @param Soiree $soiree
     * @return void
     */
    public function setSoiree(Soiree $soiree) {
        $this->soiree = $soiree;
    }

    /**
     * TRANSFORME L'ENTITY EN DTO
     * @return PanierItemDTO
     */
    public function toDTO(): PanierItemDTO
    {
        return new PanierItemDTO($this);
    }
}