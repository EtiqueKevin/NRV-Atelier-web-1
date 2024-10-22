<?php

namespace nrv\core\services\soiree;

use nrv\core\dto\soiree\SoireeDetailDTO;
use nrv\core\dto\soiree\SoireeDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;

class SoireeService implements SoireeServiceInterface
{
    private SoireesRepositoryInterface $soireeRepository;

    public function __construct($soireeRepository)
    {
        $this->soireeRepository = $soireeRepository;
    }

    public function getSoireeById($id)
    {
        try{
            $soiree = $this->soireeRepository->getSoireeById($id);
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
            throw new SoireeException($e->getMessage());
        }
    }

    public function getSoireeBySpectacle($idSpectacle)
    {
        try{
            $soiree = $this->soireeRepository->getSoireeBySpectacle($idSpectacle);
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
            throw new SoireeException("erreur lors de la récupération de la soirée");
        }
    }

    public function getSoireeDetail($idSoiree){
        try{
            $soiree = $this->soireeRepository->getSoireeByIdDetail($idSoiree);
            return new SoireeDetailDTO($soiree);
        }catch (\Exception $e) {
            throw new SoireeException("erreur lors de la récupération de la soirée detail");
        }
    }

}