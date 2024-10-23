<?php

namespace nrv\core\services\billet;

use nrv\core\dto\billet\BilletOutputDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class BilletService implements BilletServiceInterface{

    private UtilisateursRepositoryInterface $utilisateursRepository;
    private SoireesRepositoryInterface $soireesRepository;

    public function __construct(UtilisateursRepositoryInterface $utilisateursRepository, SoireesRepositoryInterface$soireesRepository){
        $this->utilisateursRepository = $utilisateursRepository;
        $this->soireesRepository = $soireesRepository;
    }

    public function getBilletsByIdUtilisateur($id): BilletOutputDTO{
        $billetsTab = $this->utilisateursRepository->getBilletsByIdUtilisateur($id);
        $billetsTabRes = [];
        foreach ($billetsTab as $b){
            $ids = $b->id_soiree;
            $soiree = $this->soireesRepository->getSoireeById($ids);
            $b->setNomSoiree($soiree->nom);
            $billetsTabRes[] = $b;
        }
        return new BilletOutputDTO($billetsTabRes);
    }
}