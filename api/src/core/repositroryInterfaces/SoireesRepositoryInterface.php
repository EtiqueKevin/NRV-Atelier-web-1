<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\spectacle\Spectacle;

interface SoireesRepositoryInterface{

    public function getAllSpectacles(int $page): array;

    public function getSpectacleByIdSoiree(string $idSoiree): array;

    public function getSoireeById(string $id): Soiree;

    public function getLieuById(string $id): Lieu;

    public function getSoireeByIdDetail(string $id): array;

    public function getImageBySpectacleId(string $specId) :array;

    public function getLieux(): array;

    public function getArtisteIdByIdSpectacle(string $idSpec): array;

    public function getArtisteById(string $id) : Artiste;

    public function getSpectacleById(string $id) : Spectacle;

    public function getIdLieuByIdSoiree(string $idSoiee): string;

    public function getNbPlaceByIdSoiee(string $idSoiee): int;

    public function getSpectacles(array $date,array $style,array $lieu, int $page): array;

    public function getStyles(): array;
}