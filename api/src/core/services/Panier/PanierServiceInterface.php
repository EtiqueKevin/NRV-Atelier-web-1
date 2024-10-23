<?php

namespace nrv\core\services\Panier;

interface PanierServiceInterface
{
    public function getPanier($idUser);

    public function addPanier($idUser, $idSoiree, $tarif, $qte);
}