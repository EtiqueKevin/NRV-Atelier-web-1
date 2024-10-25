<?php

namespace nrv\core\services\spectacle;

use Monolog\Level;
use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\dto\artiste\ArtisteDTO;
use nrv\core\dto\spectacle\InputFiltresSpectaclesDTO;
use nrv\core\dto\spectacle\SpectacleCreerDTO;
use nrv\core\dto\spectacle\SpectacleDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\services\soiree\SoireeException;
use Psr\Log\LoggerInterface;

class SpectacleService implements SpectacleServiceInterface{
    private SoireesRepositoryInterface $soireeRepository;

    private LoggerInterface $logger;

    /**
     * @param SoireesRepositoryInterface $soireeRepository
     */
    public function __construct(SoireesRepositoryInterface $soireeRepository, LoggerInterface $logger){
        $this->soireeRepository = $soireeRepository;
        $this->logger = $logger;
    }

    /**
     * RECUPERE TOUS LES SPECTACLES
     * @param InputFiltresSpectaclesDTO $filtresSpectaclesDTO
     * @return array
     * @throws spectacleException
     */
    public function getAllSpectacles(InputFiltresSpectaclesDTO $filtresSpectaclesDTO): array{
        $date = $filtresSpectaclesDTO->date;
        $style = $filtresSpectaclesDTO->style;
        $lieu = $filtresSpectaclesDTO->lieu;
        try {
            $spectacles = $this->soireeRepository->getAllSpectacles($date, $style, $lieu);
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            $this->logger->log(Level::Error, "SpectacleService - getAllSpectacles : " . date('Y-m-d H:i:s'));
            return $tabDTO;
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SpectacleService - getAllSpectacles : " . $e->getMessage() . ' | ' . date('Y-m-d H:i:s'));
            throw new spectacleException($e->getMessage());
        }
    }

    /**
     * RECUPERE LES SPECTACLES PAR RAPPORT A DES FILTRES ET UNE PAGE DONNEE, LES IL Y A PLUSIEURS DATES, PLUSIEURS STYLES,
     * PLUSIEURS LIEUX COMME FILTRES ET ILS SONT TOUS INDEPENDANTS ET OPTIONNELS
     * @param InputFiltresSpectaclesDTO $filtresSpectaclesDTO
     * @return array
     * @throws spectacleException
     */
    public function getSpectacles(InputFiltresSpectaclesDTO $filtresSpectaclesDTO): array{
        $date = $filtresSpectaclesDTO->date;
        $style = $filtresSpectaclesDTO->style;
        $lieu = $filtresSpectaclesDTO->lieu;
        $page = $filtresSpectaclesDTO->page;
        try {
            $spectacles = $this->soireeRepository->getSpectacles($date, $style, $lieu, $page);
            $tabDTO = [];
            foreach ($spectacles as $spectacle) {
                $tabDTO[] = new SpectacleDTO($spectacle);
            }
            $this->logger->log(Level::Info, "SpectacleService - getSpectacles : "  . date('Y-m-d H:i:s'));

            return $tabDTO;
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SpectacleService - getSpectacles : " . $e->getMessage() . ' | ' . date('Y-m-d H:i:s'));
            throw new spectacleException($e->getMessage());
        }
    }


    /**
     * RECUPERE UN SPECTACLE PAR RAPPORT A SON ID
     * @param string $id
     * @return SpectacleDTO
     * @throws spectacleException
     */
    public function getSpectacleById(string $id): SpectacleDTO{
        try {
            $spectacle = $this->soireeRepository->getSpectacleById($id);
            $this->logger->log(Level::Info, "SpectacleService - getSpectacleById : "  . date('Y-m-d H:i:s'));
            return new SpectacleDTO($spectacle);
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SpectacleService - getSpectacleById : " . $e->getMessage() . ' | ' . date('Y-m-d H:i:s'));
            throw new spectacleException($e->getMessage());
        }
    }

    /**
     * RECUPERE TOUS LES ARTISTES D'UN SPECTACLE
     * @param string $idSpectacle
     * @return array
     * @throws spectacleException
     */
    public function getArtistesBySpectacle(string $idSpectacle): array{
        try {
            $artistes = $this->soireeRepository->getArtisteIdByIdSpectacle($idSpectacle);
            $this->logger->log(Level::Info, "SpectacleService - getArtistesBySpectacle : " . date('Y-m-d H:i:s'));
            return $artistes;
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SpectacleService - getArtistesBySpectacle : " . $e->getMessage() . ' | ' . date('Y-m-d H:i:s'));
            throw new spectacleException($e->getMessage());
        }
    }


    /**
     * RECUPERE UN ARTISTE PAR RAPPORT A SON ID
     * @param string $idArtiste
     * @return ArtisteDTO
     * @throws spectacleException
     */
    public function getArtisteById(string $idArtiste): ArtisteDTO{
        try {
            $artiste = $this->soireeRepository->getArtisteById($idArtiste);
            $this->logger->log(Level::Info, "SpectacleService - getArtisteById : "  . date('Y-m-d H:i:s'));
            return $artiste->toDTO();
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SpectacleService - getArtisteById : " . $e->getMessage() . ' | ' . date('Y-m-d H:i:s'));
            throw new spectacleException($e->getMessage());
        }
    }


    /**
     * CREE UN SPECTACLE
     * @param SpectacleCreerDTO $spectacleDTO
     * @return void
     * @throws SoireeException
     */
    public function putSpectacle(SpectacleCreerDTO $spectacleDTO) : void{
        try{
            $spectacleEnity = new Spectacle($spectacleDTO->titre,$spectacleDTO->description,\DateTime::createFromFormat('H:i:s',$spectacleDTO->heure),$spectacleDTO->url_video,$spectacleDTO->imgs,$spectacleDTO->artistes);
            $spectacleEnity->setIdSoiree($spectacleDTO->idSoiree);
            $spectacleEnity->setArtistes($spectacleDTO->artistes);

            $this->soireeRepository->saveSpectacle($spectacleEnity);
            $this->logger->log(Level::Error, "SpectacleService - putSpectacle : "  . date('Y-m-d H:i:s'));
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "SpectacleService - putSpectacle : " . $e->getMessage() . ' | ' . date('Y-m-d H:i:s'));
            throw new SoireeException("put spectacle" . $e->getMessage());
        }
    }


    /**
     * DEPLACE UN FICHIER UPLOADER
     * @param $directory
     * @param $uploadedFile
     * @return string
     * @throws \Exception
     */
    public function moveUploadedFile($directory, $uploadedFile) :string{
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        $this->logger->log(Level::Info, "SpectacleService - moveUploadedFile : " . date('Y-m-d H:i:s'));
        return $filename;
    }
}