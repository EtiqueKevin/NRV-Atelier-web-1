<?php

namespace nrv\core\services\Panier;

use nrv\core\dto\Panier\PanierAddDTO;
use nrv\core\dto\Panier\PanierDTO;
use nrv\core\dto\Panier\PanierModifierDTO;
use nrv\core\dto\Panier\PanierVerifDTO;

interface PanierServiceInterface
{
    public function getPanier(string $idUser) : PanierDTO;

    public function addPanier(PanierAddDTO $panierAddDTO) : PanierDTO;

    public function validerPanier(string $idUser) : PanierDTO;

    public function verifier(PanierVerifDTO $panierVerifDTO, PanierDTO $panierDTO) : bool;

    public function verificationDisponibilite(int $qte, string $idSoiree):bool;

    public function modifierPanier(PanierModifierDTO $panierModifierDTO): PanierDTO;
}