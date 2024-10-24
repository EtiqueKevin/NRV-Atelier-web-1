<?php

namespace nrv\core\services\Panier;

use nrv\core\dto\Panier\PanierDTO;

interface PanierServiceInterface
{
    public function getPanier(string $idUser);

    public function addPanier(string $idUser,string $idSoiree,int $tarif, string $typeTarif, int $qte);

    public function validerPanier(string $idUser);

    public function verifier(string $numero, string $dateExpiration, string $code, PanierDTO $panierDTO) : bool;

    public function verificationDisponibilite(int $qte, string $idSoiree):bool;
}