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

    public function __construct(string $idUtilisateur,string $idPanier, bool $valide)
    {
        $this->idUtilisateur = $idUtilisateur;
        $this->idPanier = $idPanier;
        $this->valide = $valide;
    }

    public function addPanierItem(PanierItemDTO $panierItem): void
    {
        $this->panierItems[] = $panierItem;
    }

    public function toDTO(): PanierDTO
    {
        return new PanierDTO($this);
    }
}