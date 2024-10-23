<?php

namespace nrv\core\dto\Panier;

use nrv\core\dto\DTO;

class PanierDTO extends DTO
{
    private string $id;
    private string $idUtilisateur;
    private string $idSoiree;
    private float $tarif;
    private bool $valide;

    public function __construct($panier)
    {
        $this->id = $panier->ID;
        $this->idUtilisateur = $panier->idUtilisateur;
        $this->idSoiree = $panier->idSoiree;
        $this->tarif = $panier->tarif;
        $this->valide = $panier->valide;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idUtilisateur' => $this->idUtilisateur,
            'idSoiree' => $this->idSoiree,
            'tarif' => $this->tarif,
            'valide' => $this->valide
        ];
    }
}