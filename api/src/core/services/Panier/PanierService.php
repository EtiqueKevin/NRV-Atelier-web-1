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
        }catch (\Exception $e){
            throw new PanierException($e->getMessage());
        }
        return new PanierDTO($panier);

    }
}