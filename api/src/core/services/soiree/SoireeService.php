<?php

namespace nrv\core\services\soiree;

use nrv\core\dto\soiree\SoireeDetailBackofficeDTO;
use nrv\core\dto\soiree\SoireeDetailDTO;
use nrv\core\dto\soiree\SoireeDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use nrv\core\services\Panier\PanierException;
use nrv\core\services\spectacle\spectacleException;

class SoireeService implements SoireeServiceInterface{
    private SoireesRepositoryInterface $soireeRepository;

    private UtilisateursRepositoryInterface $utilisateursRepository;

    public function __construct(SoireesRepositoryInterface $soireeRepository, UtilisateursRepositoryInterface $utilisateursRepository){
        $this->soireeRepository = $soireeRepository;
        $this->utilisateursRepository = $utilisateursRepository;
    }

    public function getSoireeById(string $id): SoireeDTO{
        try{
            $soiree = $this->soireeRepository->getSoireeById($id);
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
            throw new SoireeException($e->getMessage());
        }
    }

    public function getSoireeDetail(string $idSoiree): SoireeDTO{
        try{
            $soiree = $this->soireeRepository->getSoireeById($idSoiree);
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
            throw new SoireeException("erreur lors de la récupération de la soirée detail");
        }
    }

    public function getSpectacleByIdSoiree(string $idSoiree): array{
        try{
            $tabIdSoiree = $this->soireeRepository->getSpectacleByIdSoiree($idSoiree);

        }catch (\Exception $e) {
            throw new SoireeException("erreur lors de la récupération de la soirée detail");
        }
        return $tabIdSoiree;
    }

    public function getLieux(): array{
        try {
            $lieux = $this->soireeRepository->getLieux();
            $tabDTO = [];
            foreach ($lieux as $lieu) {
                $tabDTO[] = $lieu->toDTO();
            }
            return $tabDTO;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function getStyles(): array{
        try {
            $styles = $this->soireeRepository->getStyles();
            $tabDTO = [];
            foreach ($styles as $style) {
                $tabStyle[] = $style;
            }
            return $tabStyle;
        } catch (\Exception $e) {
            throw new spectacleException($e->getMessage());
        }
    }

    public function gestionPlaceBackOffice(string $idSoiree):SoireeDetailBackofficeDTO{
        try{
            $nbPlacett = $this->soireeRepository->getNbPlaceByIdSoiee($idSoiree);
            $nbPlaceReserve = $this->utilisateursRepository->getNbBilletByIdSoiree($idSoiree);
        }catch (\Exception $e){
            throw new PanierException('gestionPlaceBackOffice : erreur lors du chargement des place : soiree : '. $idSoiree . " ".$e->getMessage());
        }
        return new SoireeDetailBackofficeDTO($nbPlacett,$nbPlaceReserve);
    }
}