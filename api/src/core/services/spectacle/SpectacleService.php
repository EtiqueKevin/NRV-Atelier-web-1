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


    public function getSpectacles($date, $style, $lieu): array
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

    public function getSpectacleById($id): SpectacleDTO
    {
        try {
            $spectacle = $this->soireeRepository->getSpectacleById($id);
            return new SpectacleDTO($spectacle);
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function getArtistesBySpectacle($idSpectacle): array
    {
        try {
            $artistes = $this->soireeRepository->getArtisteIdByIdSpectacle($idSpectacle);
            return $artistes;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function getArtisteById($idArtiste): \nrv\core\dto\artiste\ArtisteDTO
    {
        try {
            $artiste = $this->soireeRepository->getArtisteById($idArtiste);
            return $artiste->toDTO();
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }
}