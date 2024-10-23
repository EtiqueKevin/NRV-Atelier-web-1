<?php

namespace nrv\core\services\Panier;

interface PanierServiceInterface
{
    public function getPanier(string $idUser);

    public function addPanier(string $idUser,string $idSoiree,int $tarif,int $qte);
}