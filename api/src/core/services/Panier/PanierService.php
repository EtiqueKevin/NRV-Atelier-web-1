<?php

namespace nrv\core\services\Panier;

use nrv\core\domain\entities\Panier\PanierItem;
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
        try {
            $panier = $this->getPanier($idUser);
            $update = false;
            foreach ($panier->panierItems as $panierItem) {
                if ($panierItem->idSoiree == $idSoiree) {
                    if ($panierItem->tarif == $tarif) {
                        $update = true;
                        $valeur =$panierItem->qte + $qte;
                        $test = new PanierItem($panierItem->idSoiree, $panierItem->idPanier, $panierItem->tarif, $panierItem->tarifTotal, $valeur);

                        $this->UtilisateursRepository->updatePanier($panierItem);
                    }
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


}