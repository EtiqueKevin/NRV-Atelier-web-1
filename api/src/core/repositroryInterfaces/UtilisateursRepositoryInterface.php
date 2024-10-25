<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\billet\Billet;
use nrv\core\domain\entities\Panier\Panier;
use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\utilisateur\Utilisateur;

interface UtilisateursRepositoryInterface{

    /**
     * RECUPERE L'UTILISATEUR PAR RAPPORT A SON EMAIL
     * @param string $email
     * @return mixed
     */
    public function UtilisateurByEmail(string $email);

    /**
     * RECUPERER LE PANIER DE L'UTILISATEUR PAR RAPPORT A SON IDEE
     * @param string $idUser
     * @return Panier
     */
    public function getPanier(string $idUser): Panier;

    /**
     * RECUPERE LES ITEMS D'UN PANIER PAR RAPPORT A SON ID
     * @param string $idPanier
     * @return array
     */
    public function getPanierItems(string $idPanier) : array;

    /**
     * AJOUTE UN ITEM DANS LE PANIER
     * @param string $idPanier
     * @param string $idSoiree
     * @param int $tarif
     * @param string $typeTarif
     * @param int $qte
     * @return void
     */
    public function addPanier(string $idPanier,string $idSoiree,int $tarif, string $typeTarif, int $qte) : void;


    /**
     * MET A JOUR UN ITEM DANS LE PANIER
     * @param PanierItem $panierItem
     * @return void
     */
    public function updatePanier(PanierItem $panierItem) : void;


    /**
     * ENREGISTRE UN UTILISATEUR
     * @param Utilisateur $uti
     * @return string
     */
    public function saveUtilisateur(Utilisateur $uti):string;


    /**
     * VALIDE LE PANIER DE L'UTILISATEUR
     * @param string $idUser
     * @return void
     */
    public function validerPanier(string $idUser): void;


    /**
     * RECUPERE UN BILLET PAR RAPPORT A L'ID DU BILLET
     * @param string $id
     * @return Billet
     */
    public function getBilletById(string $id): Billet;


    /**
     * RECUPERE L'UTILISATEUR PAR RAPPORT A SON ID
     * @param string $id
     * @return Utilisateur
     */
    public function UtilisateurById(string $id): Utilisateur;

    /**
     * RECUPERE LES BILLETS DE L'UTILISATEUR PAR RAPPORT A SON ID
     * @param string $id
     * @return array
     */
    public function getBilletsByIdUtilisateur(string $id):array;


    /**
     * AJOUTE UN PANIER A L'UTILISATEUR
     * @param string $id
     * @return mixed
     */
    public function ajouterPanierUtilisateur(string $id);

    /**
     * RECUPERE LE NOMBRE DE BILLET PAR RAPPORT A L'ID DE LA SOIREE
     * @param string $id
     * @return int
     */
    public function getNbBilletByIdSoiree(string $id): int;


    /**
     * RECUPERE LE ROLE PAR RAPPORT A L'ID DE L'UTILISATEUR
     * @param string $id
     * @return int
     */
    public function getRole(string $id): int;


    /**
     * AJOUTE DES BILLETS DEPUIS LA CHAINE D'INSERTION PASSER EN PARAMETRE DE FACON A NE FAIRE QU'UN APPEL A LA BASE DE DONNEES
     * @param string $insertions
     * @return void
     */
    public function addBillets(string $insertions) : void;

    /**
     * VIDE LE PANIER ET LE REMET A PAS VALIDER
     * @param string $idPanier
     * @return void
     */
    public function viderPanier(string $idPanier): void;


    /**
     * SUPPRIME UN ITEM DU PANIER
     * @param PanierItem $panierItem
     * @return void
     */
    public function deletePanierItem(PanierItem $panierItem): void;
}