<?php

namespace nrv\core\services\spectacle;

use nrv\core\repositroryInterfaces\SpectacleRepositoryInterface;

class SpectacleService implements SpectacleServiceInterface
{
    private SpectacleRepositoryInterface $spectacleRepository;

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
}