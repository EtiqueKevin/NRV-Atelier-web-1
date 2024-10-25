<?php

namespace nrv\core\services\soiree;

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
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
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
            return new SoireeDTO($soiree);
        }catch (\Exception $e) {
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
            throw new SoireeException("erreur lors de la récupération de la soirée detail");
        }
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
            return $tabDTO;
        } catch (\Exception $e) {
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
            return $tabStyle;
        } catch (\Exception $e) {
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
            throw new PanierException('gestionPlaceBackOffice : erreur lors du chargement des place : soiree : '. $idSoiree . " ".$e->getMessage());
        }
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
        }catch (\Exception $e){
            throw new SoireeException("put soiree" . $e->getMessage());
        }
    }


    /**
     * RECUPERE TOUTES LES SOIREES
     * @return SoireesDTO
     */
    public function getSoirees(): SoireesDTO{
        $s = $this->soireeRepository->getSoirees();
        return new SoireesDTO($s);
    }
}