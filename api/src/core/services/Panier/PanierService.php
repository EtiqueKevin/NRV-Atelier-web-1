<?php

namespace nrv\core\services\Panier;

use nrv\core\dto\Panier\PanierAddDTO;
use nrv\core\dto\Panier\PanierDTO;
use nrv\core\dto\Panier\PanierModifierDTO;
use nrv\core\dto\Panier\PanierVerifDTO;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class PanierService implements PanierServiceInterface
{

    private UtilisateursRepositoryInterface $UtilisateursRepository;
    private SoireesRepositoryInterface $SoireesRepository;

    public function __construct(UtilisateursRepositoryInterface $utilisateursRepository, SoireesRepositoryInterface $soireesRepository)
    {
        $this->UtilisateursRepository = $utilisateursRepository;
        $this->SoireesRepository = $soireesRepository;
    }

    public function getPanier(string $idUser) : PanierDTO
    {
        try {
            $panier = $this->UtilisateursRepository->getPanier($idUser);
            $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier);

            if(empty($panierItemsRes)){
                return new PanierDTO($panier);
            }

            foreach ($panierItemsRes as $panierItem){
                $panierItem->setSoiree($this->SoireesRepository->getSoireeById($panierItem->idSoiree));
                $panier->addPanierItem($panierItem->toDTO());
            }

        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return new PanierDTO($panier);

    }

    public function addPanier(PanierAddDTO $panierAddDTO) :PanierDTO
    {
        $idUser = $panierAddDTO->idUser;
        $idSoiree = $panierAddDTO->idSoiree;
        $tarif = $panierAddDTO->tarif;
        $typeTarif = $panierAddDTO->typeTarif;
        $qte = $panierAddDTO->qte;
        try {
            $panier = $this->UtilisateursRepository->getPanier($idUser); //je récupère le panier de l'utilisateur
            if(!$panier->valide){
                $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier); //je récupère les items du panier de l'utilisateur
                $update = false; //booléen pour savoir si l'item est déjà dans le panier et si ça fait une update
                foreach ($panierItemsRes as $panierItem) { //on vérifie tous les items du panier
                    if ($panierItem->idSoiree == $idSoiree && $panierItem->typeTarif == $typeTarif) { //si la soiree et le type de tarif sont les mêmes ça veut dire que c'est déjà dans le panier
                        $update = true; //on met à jour le booléen
                        $panierItem->setQte($panierItem->qte + $qte); //on ajoute la quantité a la soiree deja existante
                        if($this->verificationDisponibilite($panierItem->qte,$idSoiree)){ //on vérifie si la quantité est disponible
                            $this->UtilisateursRepository->updatePanier($panierItem); //on met à jour le panier
                        }
                    }
                }
                if(!$update){ //si l'item n'est pas dans le panier
                    if($this->verificationDisponibilite($qte,$idSoiree)) { //on vérifie si la quantité est disponible
                        $this->UtilisateursRepository->addPanier($panier->idPanier, $idSoiree, $tarif, $typeTarif, $qte); //on ajoute l'item au panier
                    }
                }
                $retour = $this->getPanier($idUser); //on retourne le panier
            }else{
                throw new PanierException('erreur panier déjà valider');
            }

        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return $retour;
    }

    public function modifierPanier(PanierModifierDTO $panierModifierDTO) : PanierDTO {
        $idUser = $panierModifierDTO->idUser;
        $idSoiree = $panierModifierDTO->idSoiree;
        $typeTarif = $panierModifierDTO->typeTarif;
        $qte = $panierModifierDTO->qte;
        try {
            $panier = $this->UtilisateursRepository->getPanier($idUser); //je récupère le panier de l'utilisateur
            if(!$panier->valide) {
                $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier); //je récupère les items du panier de l'utilisateur
                foreach ($panierItemsRes as $panierItem) { //on vérifie tous les items du panier
                    if ($panierItem->idSoiree == $idSoiree && $panierItem->typeTarif == $typeTarif) { //si la soiree est la même
                        $panierItem->setQte($qte); //on met à jour la quantité
                        if ($this->verificationDisponibilite($panierItem->qte, $idSoiree)) { //on vérifie si la quantité est disponible
                            $this->UtilisateursRepository->updatePanier($panierItem); //on met à jour le panier
                        }
                    }
                }

                $retour = $this->getPanier($idUser); //on retourne le panier
            }else{
                throw new PanierException('erreur panier déjà valider');
            }
        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return $retour;
    }

    public function validerPanier(string $idUser) : PanierDTO
    {
        try {
            $this->UtilisateursRepository->validerPanier($idUser);
            return $this->getPanier($idUser);
        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
    }

    public function verifier(PanierVerifDTO $panierVerifDTO, PanierDTO $panierDTO) : bool
    {
        $numero = $panierVerifDTO->numero;
        $dateExpiration = $panierVerifDTO->dateExpiration;
        $code = $panierVerifDTO->code;

        try {

            foreach ($panierDTO->panierItems as $panierItem) {
                $this->verificationDisponibilite($panierItem->qte, $panierItem->idSoiree);
            }
        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }

        return true;
    }

    public function verificationDisponibilite(int $qte, string $idSoiree):bool{
        try {
            $nbPlacett = $this->SoireesRepository->getNbPlaceByIdSoiee($idSoiree);
            $nbBillettt = $this->UtilisateursRepository->getNbBilletByIdSoiree($idSoiree);
        }catch (\Exception){
            throw new PanierException('erreur lors du chargement des places');
        }

        $nbPlacesRestantes = $nbPlacett - $nbBillettt;

        if(($qte < 0) || ($qte > $nbPlacett)){
            throw new PanierException('nombre de place incorrect : '.$qte . ' nombre de place total : '.$nbPlacett);
        }

        if($qte > $nbPlacesRestantes){
            throw new PanierException('nombre de place incorrect : '.$qte. ' pas assez de place disponible : '.$nbPlacesRestantes);
        }

        return true;
    }
}