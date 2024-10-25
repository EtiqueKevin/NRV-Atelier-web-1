<?php

namespace nrv\core\services\Panier;

use Monolog\Level;
use nrv\core\dto\Panier\PanierAddDTO;
use nrv\core\dto\Panier\PanierDTO;
use nrv\core\dto\Panier\PanierModifierDTO;
use nrv\core\dto\Panier\PanierVerifDTO;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use Psr\Log\LoggerInterface;

class PanierService implements PanierServiceInterface
{

    private UtilisateursRepositoryInterface $UtilisateursRepository;
    private SoireesRepositoryInterface $SoireesRepository;

    private LoggerInterface $logger;

    /**
     * @param UtilisateursRepositoryInterface $utilisateursRepository
     * @param SoireesRepositoryInterface $soireesRepository
     */
    public function __construct(UtilisateursRepositoryInterface $utilisateursRepository, SoireesRepositoryInterface $soireesRepository, LoggerInterface $logger)
    {
        $this->UtilisateursRepository = $utilisateursRepository;
        $this->SoireesRepository = $soireesRepository;
        $this->logger = $logger;
    }

    /**
     * RECUPERE LE PANIER D'UN UTILISATEUR
     * @param string $idUser
     * @return PanierDTO
     * @throws PanierException
     */
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
            $this->logger->log(Level::Error, "PanierService - getPanier : id uti : ". $idUser." ");
            throw new PanierException($e->getMessage());
        }
        $this->logger->log(Level::Info, "PanierService - getPanier : id uti : ". $idUser." ");
        return new PanierDTO($panier);

    }


    /**
     * AJOUTE UN ITEM DANS LE PANIER
     * @param PanierAddDTO $panierAddDTO
     * @return PanierDTO
     * @throws PanierException
     */
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
                $this->logger->log(Level::Error, "PanierService - addPanier : id uti : ". $idUser." ");
                throw new PanierException('erreur panier déjà valider');
            }

        }catch (\Exception $e){
            $this->logger->log(Level::Error, "PanierService - addPanier : id uti : ". $idUser." ");
            throw new PanierException($e->getMessage());
        }
        $this->logger->log(Level::Info, "PanierService - addPanier : id uti : ". $idUser." ");
        return $retour;
    }


    /**
     * MODIFIER UN ITEM DANS LE PANIER
     * @param PanierModifierDTO $panierModifierDTO
     * @return PanierDTO
     * @throws PanierException
     */
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
                            if ($qte == 0) { //si la quantité est 0 on supprime l'item
                                $this->UtilisateursRepository->deletePanierItem($panierItem);
                            } else {
                                $this->UtilisateursRepository->updatePanier($panierItem); //on met à jour le panier
                            }
                        }
                    }
                }

                $retour = $this->getPanier($idUser); //on retourne le panier
            }else{
                $this->logger->log(Level::Error, "PanierService - modifierPanier : id uti : ". $idUser." ");
                throw new PanierException('erreur panier déjà valider');
            }
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "PanierService - modifierPanier : id uti : ". $idUser." ");
            throw new PanierException($e->getMessage());
        }
        $this->logger->log(Level::Info, "PanierService - modifierPanier : id uti : ". $idUser." ");
        return $retour;
    }


    /**
     * VALIDE UN PANIER D'UN UTILISATEUR
     * @param string $idUser
     * @return PanierDTO
     * @throws PanierException
     */
    public function validerPanier(string $idUser) : PanierDTO
    {

        try {
            $panierTab = $this->getPanier($idUser);
            if(count($panierTab->panierItems) === 0){
                throw new PanierException('panier vide');
            }
            if ($panierTab->valide){
                throw new PanierException('panier déjà validé');
            }
            $this->UtilisateursRepository->validerPanier($idUser);
            $this->logger->log(Level::Info, "PanierService - validerPanier : id uti : ". $idUser." ");
            return $this->getPanier($idUser);
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "PanierService - validerPanier : id uti : ". $idUser." ");
            throw new PanierException($e->getMessage());
        }
    }


    /**
     * VERIFIE UN PANIER
     * @param PanierVerifDTO $panierVerifDTO
     * @param PanierDTO $panierDTO
     * @return bool
     * @throws PanierException
     */
    public function verifier(PanierVerifDTO $panierVerifDTO, PanierDTO $panierDTO) : bool
    {
        $numero = $panierVerifDTO->numero;
        $dateExpiration = $panierVerifDTO->date;
        $code = $panierVerifDTO->code;

        try {

            foreach ($panierDTO->panierItems as $panierItem) {
                $this->verificationDisponibilite($panierItem->qte, $panierItem->idSoiree);
            }
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "PanierService - vérifier ");
            throw new PanierException($e->getMessage());
        }
        $this->logger->log(Level::Info, "PanierService - vérifier");
        return true;
    }


    /**
     * VERIFIE LA DISPONIBILITE D'UNE SOIREE (QUANTITE DE PLACES)
     * @param int $qte
     * @param string $idSoiree
     * @return bool
     * @throws PanierException
     */
    public function verificationDisponibilite(int $qte, string $idSoiree):bool{
        try {
            $nbPlacett = $this->SoireesRepository->getNbPlaceByIdSoiee($idSoiree);
            $nbBillettt = $this->UtilisateursRepository->getNbBilletByIdSoiree($idSoiree);
        }catch (\Exception){
            $this->logger->log(Level::Error, "PanierService - verificationDisponibilite : id soiree : ". $idSoiree." ");
            throw new PanierException('erreur lors du chargement des places');
        }

        $nbPlacesRestantes = $nbPlacett - $nbBillettt;

        if(($qte < 0) || ($qte > $nbPlacett)){
            throw new PanierException('nombre de place incorrect : '.$qte . ' nombre de place total : '.$nbPlacett);
        }

        if($qte > $nbPlacesRestantes){
            throw new PanierException('nombre de place incorrect : '.$qte. ' pas assez de place disponible : '.$nbPlacesRestantes);
        }
        $this->logger->log(Level::Info, "PanierService - verificationDisponibilite : id soiree : ". $idSoiree." ");
        return true;
    }
}