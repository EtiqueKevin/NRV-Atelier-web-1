<?php

namespace nrv\core\services\Panier;

use nrv\core\dto\Panier\PanierDTO;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class PanierService implements PanierServiceInterface
{

    private UtilisateursRepositoryInterface $UtilisateursRepository;

    public function __construct(UtilisateursRepositoryInterface $utilisateursRepository)
    {
        $this->UtilisateursRepository = $utilisateursRepository;
    }

    public function getPanier($idUser) : PanierDTO
    {
        try {
            $panier = $this->UtilisateursRepository->getPanier($idUser);
            $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier);

            foreach ($panierItemsRes as $panierItem){
                $panier->addPanierItem($panierItem->toDTO());
            }

        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return new PanierDTO($panier);

    }

    public function addPanier($idUser, $idSoiree, $tarif, $qte) :PanierDTO
    {
        $retour = null;
        try {
            $panier = $this->getPanier($idUser);
            foreach ($panier->panierItems as $panierItem){
                if($panierItem->idSoiree == $idSoiree){
                    if ($panierItem->tarif != $tarif){
                       $this->UtilisateursRepository->addPanier($panier->idPanier, $idSoiree, $tarif, $qte);
                    }else {
                        $panierItem->qte += $qte;
                        $this->UtilisateursRepository->updatePanier($panierItem);
                    }
                }else{
                    $this->UtilisateursRepository->addPanier($panier->idPanier, $idSoiree, $tarif, $qte);
                }
                $retour =  $this->getPanier($idUser);
            }
        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return $retour;
    }
}