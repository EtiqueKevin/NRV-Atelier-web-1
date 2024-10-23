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

    public function getPanier(string $idUser) : PanierDTO
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

    public function addPanier(string $idUser,string $idSoiree,int $tarif,int $qte) :PanierDTO
    {
        try {
            $panier = $this->UtilisateursRepository->getPanier($idUser);
            $panierItemsRes = $this->UtilisateursRepository->getPanierItems($panier->idPanier);
            $update = false;
            foreach ($panierItemsRes as $panierItem) {
                if ($panierItem->idSoiree == $idSoiree && $panierItem->tarif == $tarif) {
                    echo "caca";
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


}