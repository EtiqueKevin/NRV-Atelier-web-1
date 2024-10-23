<?php

namespace nrv\core\dto\Panier;

use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class PanierDTO extends DTO
{
    protected string $id;
    protected string $idUtilisateur;
    protected string $idPanier;

    protected array $panierItems;
    protected bool $valide;

    public function __construct($panier)
    {
        $this->id = $panier->ID;
        $this->idUtilisateur = $panier->idUtilisateur;
        $this->idPanier = $panier->idPanier;
        $this->panierItems = $panier->panierItems;
        $this->valide = $panier->valide;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idUtilisateur' => $this->idUtilisateur,
            'panierItems' => $this->panierItems,
            'valide' => $this->valide
        ];
    }
}