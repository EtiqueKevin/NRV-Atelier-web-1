<?php

namespace nrv\core\services\spectacle;

use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\dto\artiste\ArtisteDTO;
use nrv\core\dto\spectacle\SpectacleCreerDTO;
use nrv\core\dto\spectacle\SpectacleDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\services\soiree\SoireeException;

class SpectacleService implements SpectacleServiceInterface{
    private SoireesRepositoryInterface $soireeRepository;

    public function __construct(SoireesRepositoryInterface $soireeRepository){
        $this->soireeRepository = $soireeRepository;
    }

    public function getAllSpectacles(int $page): array{
        try {
            $spectacles = $this->soireeRepository->getAllSpectacles($page);
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            return $tabDTO;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }


    public function getSpectacles(array $date,array $style,array $lieu, int $page): array{
        try {
            $spectacles = $this->soireeRepository->getSpectacles($date, $style, $lieu, $page);
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            return $tabDTO;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function getSpectacleById(string $id): SpectacleDTO{
        try {
            $spectacle = $this->soireeRepository->getSpectacleById($id);
            return new SpectacleDTO($spectacle);
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function getArtistesBySpectacle(string $idSpectacle): array{
        try {
            $artistes = $this->soireeRepository->getArtisteIdByIdSpectacle($idSpectacle);
            return $artistes;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function getArtisteById(string $idArtiste): ArtisteDTO{
        try {
            $artiste = $this->soireeRepository->getArtisteById($idArtiste);
            return $artiste->toDTO();
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function putSpectacle(SpectacleCreerDTO $spectacleDTO) : void{
        try{
            $spectacleEnity = new Spectacle($spectacleDTO->titre,$spectacleDTO->description,\DateTime::createFromFormat('H:i:s',$spectacleDTO->heure),$spectacleDTO->url_video,$spectacleDTO->imgs);
            $spectacleEnity->setIdSoiree($spectacleDTO->idSoiree);

            $this->soireeRepository->saveSpectacle($spectacleEnity);

        }catch (\Exception $e){
            throw new SoireeException("put spectacle" . $e->getMessage());
        }
    }
}