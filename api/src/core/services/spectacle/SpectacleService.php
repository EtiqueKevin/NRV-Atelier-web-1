<?php

namespace nrv\core\services\spectacle;

use nrv\core\dto\spectacle\SpectacleDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;

class SpectacleService implements SpectacleServiceInterface
{
    private SoireesRepositoryInterface $soireeRepository;

    public function __construct($soireeRepository)
    {
        $this->soireeRepository = $soireeRepository;
    }

    public function getAllSpectacles(): array
    {
        try {
            $spectacles = $this->soireeRepository->getAllSpectacles();
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            return $tabDTO;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }


    public function getSpectacles($date, $style, $lieu)
    {
        try {
            $spectacles = $this->soireeRepository->getSpectacles($date, $style, $lieu);
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            return $tabDTO;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }
}