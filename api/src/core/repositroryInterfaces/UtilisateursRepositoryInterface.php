<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\Panier\Panier;
use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\utilisateur\UtilisateurInputCreationSaveDTO;

interface UtilisateursRepositoryInterface{

    public function UtilisateurByEmail(string $email);

    public function getPanier(string $idUser): Panier;

    public function getPanierItems(string $idPanier) : array;

    public function addPanier(string $idPanier,string $idSoiree,int $tarif,int $qte) : void;

    public function updatePanier(PanierItem $panierItem) : void;

    public function saveUtilisateur(Utilisateur $uti):string;

    public function validerPanier(string $idUser): void;
}