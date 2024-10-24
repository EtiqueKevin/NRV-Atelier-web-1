<?php

namespace nrv\core\services\Panier;

use nrv\core\dto\Panier\PanierDTO;
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

    public function addPanier(string $idUser,string $idSoiree,int $tarif, string $typeTarif, int $qte) :PanierDTO
    {
        try {
            if($this->verificationDisponibilite($qte,$idSoiree)){
                $panier = $this->UtilisateursRepository->getPanier($idUser);
                $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier);
                $update = false;
                foreach ($panierItemsRes as $panierItem) {
                    if ($panierItem->idSoiree == $idSoiree && $panierItem->typeTarif == $typeTarif) {
                        $update = true;
                        $panierItem->setQte($panierItem->qte + $qte);
                        $this->UtilisateursRepository->updatePanier($panierItem);
                    }
                }

                if(!$update){
                    $this->UtilisateursRepository->addPanier($panier->idPanier, $idSoiree, $typeTarif, $qte);
                }
                $retour = $this->getPanier($idUser);
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

    public function verifier(string $numero, string $dateExpiration, string $code, PanierDTO $panierDTO) : bool
    {
        $date = \DateTime::createFromFormat('m/Y', $dateExpiration);
        $dateActuellle = new \DateTime();
        $dateActuellle = $dateActuellle->format('m/Y');

        if (!preg_match('/^d{16}$/', $numero)) {
            throw new PanierException('Numero invalide');
        }

        if($date < $dateActuellle){
            throw new PanierException('Date d\'expiration invalide');
        }

        if(!preg_match('/^d{3}$/', $code) ){
            throw new PanierException('Code invalide');
        }

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