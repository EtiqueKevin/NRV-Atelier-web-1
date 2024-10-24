<?php

namespace nrv\core\services\Panier;

use nrv\core\dto\Panier\PanierDTO;

interface PanierServiceInterface
{
    public function getPanier(string $idUser) : PanierDTO;

    public function addPanier(string $idUser,string $idSoiree,int $tarif, string $typeTarif, int $qte) : PanierDTO;

    public function validerPanier(string $idUser) : PanierDTO;

    public function verifier(string $numero, string $dateExpiration, string $code, PanierDTO $panierDTO) : bool;

    public function verificationDisponibilite(int $qte, string $idSoiree):bool;

    public function modifierPanier(string $idUser, string $idSoiree, string $typeTarif, int $qte): PanierDTO;
}