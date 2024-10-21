<?php

namespace nrv\core\services\spectacle;

use nrv\core\dto\specialite\SpectacleDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;

class SpectacleService implements SpectacleServiceInterface
{
    private SoireesRepositoryInterface $soireeRepository;

    public function __construct($soireeRepository)
    {
        $this->soireeRepository = $soireeRepository;
    }

    public function getAllSpectacles() : array
    {
        try{
            $spectacles = $this->soireeRepository->getAllSpectacles();
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            return $tabDTO;
        }catch (\Exception $e) {
            throw new spectacleException("erreur lors de la récupération des spectacles");
        }
    }

    public function getSpectacleByIdSoiree($idSoiree) : array
    {
        try{
            $spectacles = $this->soireeRepository->getSpectacleByIdSoiree($idSoiree);
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            return $tabDTO;
        }catch (\Exception $e) {
            throw new spectacleException("erreur lors de la récupération des spectacles");
        }
    }
}