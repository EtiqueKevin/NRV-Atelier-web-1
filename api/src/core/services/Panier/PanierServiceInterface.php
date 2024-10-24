<?php

namespace nrv\core\services\Panier;

interface PanierServiceInterface
{
    public function getPanier(string $idUser);

    public function addPanier(string $idUser,string $idSoiree,int $tarif,int $qte);

    public function validerPanier(string $idUser);

    public function verifier(string $numero, string $dateExpiration, string $code) : bool;

    public function verificationDisponibilite(int $qte, string $idSoiree):bool;
}