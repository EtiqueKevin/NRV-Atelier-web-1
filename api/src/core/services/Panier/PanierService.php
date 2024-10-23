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

            foreach ($panierItemsRes as $panierItem){
                $panierItem->setSoiree($this->SoireesRepository->getSoireeById($panierItem->idSoiree));
                $panier->addPanierItem($panierItem->toDTO());
            }

        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return new PanierDTO($panier);

    }

    public function addPanier(string $idUser,string $idSoiree,int $tarif,int $qte) :PanierDTO
    {
        try {
            $panier = $this->UtilisateursRepository->getPanier($idUser);
            $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier);
            $update = false;
            foreach ($panierItemsRes as $panierItem) {
                if ($panierItem->idSoiree == $idSoiree && $panierItem->tarif == $tarif) {
                    $update = true;
                    $panierItem->setQte($panierItem->qte + $qte);
                    $this->UtilisateursRepository->updatePanier($panierItem);
                }
            }

            if(!$update){
                $this->UtilisateursRepository->addPanier($panier->idPanier, $idSoiree, $tarif, $qte);
            }
            $retour = $this->getPanier($idUser);
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
}