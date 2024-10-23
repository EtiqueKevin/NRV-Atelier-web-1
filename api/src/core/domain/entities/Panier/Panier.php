<?php

namespace nrv\core\domain\entities\Panier;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\Panier\PanierDTO;

class Panier extends Entity
{
    protected string $idUtilisateur;
    protected string $idSoiree;
    protected float $tarif;
    protected bool $valide;

    public function __construct(string $idUtilisateur, string $idSoiree, float $tarif, bool $valide)
    {
        $this->idUtilisateur = $idUtilisateur;
        $this->idSoiree = $idSoiree;
        $this->tarif = $tarif;
        $this->valide = $valide;
    }

    public function toDTO(): PanierDTO
    {
        return new PanierDTO($this);
    }
}