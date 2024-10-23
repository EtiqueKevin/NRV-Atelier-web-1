<?php

namespace nrv\core\dto\Panier;

use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class PanierDTO extends DTO
{
    private string $id;
    private string $idUtilisateur;
    private string $idPanier;

    private array $panierItems;
    private bool $valide;

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