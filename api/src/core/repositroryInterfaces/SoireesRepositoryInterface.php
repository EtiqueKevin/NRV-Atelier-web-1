<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\spectacle\Spectacle;

interface SoireesRepositoryInterface{


    /**
     * RECUPERE TOUS LES SPECTACLES
     * @param array $date
     * @param array $style
     * @param array $lieu
     * @return array
     */
    public function getAllSpectacles(array $date, array $style, array $lieu): array;

    /**
     * RECUPERE LES ID SPECTACLES PAR RAPPORT A L'ID DE LA SOIREE
     * @param string $idSoiree
     * @return array
     */
    public function getSpectacleByIdSoiree(string $idSoiree): array;

    /**
     * RECUPERE UNE SOIREE PAR RAPPORT A SON ID
     * @param string $id
     * @return Soiree
     */
    public function getSoireeById(string $id): Soiree;

    /**
     * RECUPERE UN LIEU PAR RAPPORT A SON ID
     * @param string $id
     * @return Lieu
     */
    public function getLieuById(string $id): Lieu;

    /**
     * RECUPERE UNE SOIREE PAR RAPPORT A SON ID AVEC LES DETAILS
     * @param string $id
     * @return array
     */
    public function getSoireeByIdDetail(string $id): array;

    /**
     * RECUPERE LES IMAGES PAR RAPPORT A L'ID DU SPECTACLE
     * @param string $specId
     * @return array
     */
    public function getImageBySpectacleId(string $specId) :array;


    /**
     * RECUPERE TOUS LES LIEUX
     * @return array
     */
    public function getLieux(): array;


    /**
     * RECUPERE TOUS LES ARTISTES PAR RAPPORT A L'ID DU SPECTACLE
     * @param string $idSpec
     * @return array
     */
    public function getArtisteIdByIdSpectacle(string $idSpec): array;


    /**
     * RECUPERE UN ARTISTE PAR RAPPORT A SON ID
     * @param string $id
     * @return Artiste
     */
    public function getArtisteById(string $id) : Artiste;


    /**
     * RECUPERE UN SPECTACLE PAR RAPPORT A SON ID
     * @param string $id
     * @return Spectacle
     */
    public function getSpectacleById(string $id) : Spectacle;


    /**
     * RECUPERE UN ID DE LIEU PAR RAPPORT A L'ID DE LA SOIREE
     * @param string $idSoiee
     * @return string
     */
    public function getIdLieuByIdSoiree(string $idSoiee): string;


    /**
     * RECUPERE LE NOMBRE DE PLACE PAR RAPPORT A L'ID DE LA SOIREE
     * @param string $idSoiee
     * @return int
     */
    public function getNbPlaceByIdSoiee(string $idSoiee): int;


    /**
     * RECUPERE LES SPECTACLES PAR RAPPORT A LA DATE, LE STYLE ET LE LIEU, ET LA PAGE, POUR LES FILTRES,
     * CHACUN EST INDEPENDANT ET OPTIONNEL
     * @param array $date
     * @param array $style
     * @param array $lieu
     * @param int $page
     * @return array
     */
    public function getSpectacles(array $date,array $style,array $lieu, int $page): array;

    /**
     * RECUPERE TOUS LES STYLES
     * @return array
     */
    public function getStyles(): array;

    /**
     * CREE UNE NOUVELLE SOIREE
     * @param Soiree $soiree
     * @return void
     */
    public function saveSoiree(Soiree $soiree): void;

    /**
     * LIE UNE IMAGE A UN SPECTACLE
     * @param array $imgs
     * @param string $idSpec
     * @return void
     */
    public function liaisonImageSpectacle(array $imgs, string $idSpec):void;

    /**
     * CREE UN SPECTACLE
     * @param Spectacle $spectacle
     * @return Spectacle
     */
    public function saveSpectacle(Spectacle $spectacle): Spectacle;

    /**
     * RECUPERE TOUS LES ARTISTES
     * @return array
     */
    public function getArtistes(): array;

    /**
     * RECUPERE TOUS LES SOIREES
     * @return array
     */
    public function getSoirees(): array;
}