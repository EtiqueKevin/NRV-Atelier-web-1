<?php

namespace nrv\core\domain\entities\Panier;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\Panier\PanierDTO;
use nrv\core\dto\Panier\PanierItemDTO;

class Panier extends Entity
{
    protected string $idUtilisateur;
    protected string $idPanier;
    protected array $panierItems;
    protected bool $valide;


    /**
     * @param string $idUtilisateur
     * @param string $idPanier
     * @param bool $valide
     */
    public function __construct(string $idUtilisateur,string $idPanier, bool $valide)
    {
        $this->idUtilisateur = $idUtilisateur;
        $this->idPanier = $idPanier;
        $this->panierItems = [];
        $this->valide = $valide;
    }

    /**
     * AJOUTE UN ITEM AU PANIER
     * @param PanierItemDTO $panierItem
     * @return void
     */
    public function addPanierItem(PanierItemDTO $panierItem): void
    {
        $this->panierItems[] = $panierItem;
    }


    /**
     * TRANSFORME L'ENTITY EN DTO
     * @return PanierDTO
     */
    public function toDTO(): PanierDTO
    {
        return new PanierDTO($this);
    }
}