<?php

namespace nrv\core\services\spectacle;

use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;

class SpectacleService implements SpectacleServiceInterface
{
    private SoireesRepositoryInterface $spectacleRepository;

    public function __construct($spectacleRepository)
    {
        $this->spectacleRepository = $spectacleRepository;
    }

    public function getAllSpectacles() : array
    {
        try{
            $spectacles = $this->spectacleRepository->getAllSpectacles();
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
            $spectacles = $this->spectacleRepository->getSpectacleByIdSoiree($idSoiree);
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