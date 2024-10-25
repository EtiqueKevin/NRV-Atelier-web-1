<?php

namespace nrv\core\services\soiree;

use Monolog\Level;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\soiree\SoireeCreerDTO;
use nrv\core\dto\soiree\SoireeDetailBackofficeDTO;
use nrv\core\dto\soiree\SoireeDetailDTO;
use nrv\core\dto\soiree\SoireeDTO;
use nrv\core\dto\soiree\SoireesDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use nrv\core\services\Panier\PanierException;
use nrv\core\services\spectacle\spectacleException;
use Psr\Log\LoggerInterface;

class SoireeService implements SoireeServiceInterface{
    private SoireesRepositoryInterface $soireeRepository;

    private UtilisateursRepositoryInterface $utilisateursRepository;

    private LoggerInterface $logger;

    /**
     * @param SoireesRepositoryInterface $soireeRepository
     * @param UtilisateursRepositoryInterface $utilisateursRepository
     */
    public function __construct(SoireesRepositoryInterface $soireeRepository, UtilisateursRepositoryInterface $utilisateursRepository, LoggerInterface $logger){
        $this->soireeRepository = $soireeRepository;
        $this->utilisateursRepository = $utilisateursRepository;
        $this->logger = $logger;
    }

    /**
     * RECUPRE UNE SOIREE PAR RAPPORT A SON ID
     * @param string $id
     * @return SoireeDTO
     * @throws SoireeException
     */
    public function getSoireeById(string $id): SoireeDTO{
        try{
            $soiree = $this->soireeRepository->getSoireeById($id);
            $this->logger->log(Level::Info, "SoireeService - getSoireeById : id soiree : ". $id." ");
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
            $this->logger->log(Level::Error, "SoireeService - getSoireeById : id soiree : ". $id." ");
            throw new SoireeException($e->getMessage());
        }
    }


    /**
     * RECUPRE UNE SOIREE PAR RAPPORT A SON ID AVEC LES DETAILS
     * @param string $idSoiree
     * @return SoireeDTO
     * @throws SoireeException
     */
    public function getSoireeDetail(string $idSoiree): SoireeDTO{
        try{
            $soiree = $this->soireeRepository->getSoireeById($idSoiree);
            $this->logger->log(Level::Info, "SoireeService - getSoireeDetail : id soiree : ". $idSoiree);
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
            $this->logger->log(Level::Error, "SoireeService - getSoireeDetail : id soiree : ". $idSoiree);
            throw new SoireeException("erreur lors de la récupération de la soirée detail");
        }
    }

    /**
     * RECUPERE LES ID SPECTACLES PAR RAPPORT A L'ID DE LA SOIREE
     * @param string $idSoiree
     * @return array
     * @throws SoireeException
     */
    public function getSpectacleByIdSoiree(string $idSoiree): array{
        try{
            $tabIdSoiree = $this->soireeRepository->getSpectacleByIdSoiree($idSoiree);

        }catch (\Exception $e) {
            $this->logger->log(Level::Error, "SoireeService - getSpectacleByIdSoiree : id soiree : ". $idSoiree);
            throw new SoireeException("erreur lors de la récupération de la soirée detail");
        }
        $this->logger->log(Level::Info, "SoireeService - getSpectacleByIdSoiree : id soiree : ". $idSoiree);
        return $tabIdSoiree;
    }

    /**
     * RECUPERE TOUS LES LIEUX
     * @return array
     * @throws spectacleException
     */
    public function getLieux(): array{
        try {
            $lieux = $this->soireeRepository->getLieux();
            $tabDTO = [];
            foreach ($lieux as $lieu) {
                $tabDTO[] = $lieu->toDTO();
            }
            $this->logger->log(Level::Info, "SoireeService - getLieux");
            return $tabDTO;
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SoireeService - getLieux");
            throw new spectacleException($e->getMessage());
        }
    }


    /**
     * RECUPERE TOUS LES STYLES
     * @return array
     * @throws spectacleException
     */
    public function getStyles(): array{
        try {
            $styles = $this->soireeRepository->getStyles();
            $tabDTO = [];
            foreach ($styles as $style) {
                $tabStyle[] = $style;
            }
            $this->logger->log(Level::Info, "SoireeService - getStyles");
            return $tabStyle;
        } catch (\Exception $e) {
            $this->logger->log(Level::Error, "SoireeService - getStyles");
            throw new spectacleException($e->getMessage());
        }
    }


    /**
     * VA CHERCHER LE NOMBRE DE PLACE PRISES ET TOTAL D'UNE SOIREE
     * @param string $idSoiree
     * @return SoireeDetailBackofficeDTO
     * @throws PanierException
     */
    public function gestionPlaceBackOffice(string $idSoiree):SoireeDetailBackofficeDTO{
        try{
            $nbPlacett = $this->soireeRepository->getNbPlaceByIdSoiee($idSoiree);
            $nbPlaceReserve = $this->utilisateursRepository->getNbBilletByIdSoiree($idSoiree);
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "SoireeService - gestionPlaceBackOffice");
            throw new PanierException('gestionPlaceBackOffice : erreur lors du chargement des place : soiree : '. $idSoiree . " ".$e->getMessage());
        }
        $this->logger->log(Level::Info, "SoireeService - gestionPlaceBackOffice");
        return new SoireeDetailBackofficeDTO($nbPlacett,$nbPlaceReserve);
    }


    /**
     * CREE UNE SOIREE
     * @param SoireeCreerDTO $soireeCreerDTO
     * @return void
     * @throws SoireeException
     */
    public function postSoiree(SoireeCreerDTO $soireeCreerDTO): void{
        try{
            $nom = $soireeCreerDTO->nom;
            $thematique = $soireeCreerDTO->thematique;
            $tarif_normal = $soireeCreerDTO->tarif_normal;
            $tarif_reduit = $soireeCreerDTO->tarif_reduit;
            $lieu = $this->soireeRepository->getLieuById($soireeCreerDTO->lieu);
            $lieu->setID($soireeCreerDTO->lieu);
            $date = \DateTime::createFromFormat('Y-m-d', $soireeCreerDTO->date);

            $soiree = new Soiree($nom, $thematique, $date, $lieu, $tarif_normal, $tarif_reduit);
            $this->soireeRepository->saveSoiree($soiree);
            $this->logger->log(Level::Info, "SoireeService - postSoiree");
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "SoireeService - postSoiree");
            throw new SoireeException("put soiree" . $e->getMessage());
        }
    }


    /**
     * RECUPERE TOUTES LES SOIREES
     * @return SoireesDTO
     */
    public function getSoirees(): SoireesDTO{
        try {
            $s = $this->soireeRepository->getSoirees();
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "SoireeService - getSoirees");
            throw new SoireeException("SoireeService : getSoirees ".$e->getMessage());
        }
        $this->logger->log(Level::Info, "SoireeService - getSoirees");
        return new SoireesDTO($s);
    }
}