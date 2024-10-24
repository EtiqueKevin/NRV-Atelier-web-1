<?php

namespace nrv\core\services\spectacle;

use nrv\core\dto\artiste\ArtisteDTO;
use nrv\core\dto\spectacle\SpectacleCreerDTO;
use nrv\core\dto\spectacle\SpectacleDTO;

interface SpectacleServiceInterface
{
    public function getAllSpectacles(int $page): array;

    public function getSpectacles(array $date,array $style,array $lieu, int $page): array;

    public function getSpectacleById(string $id): SpectacleDTO;

    public function getArtistesBySpectacle(string $idSpectacle): array;

    public function getArtisteById(string $idArtiste): ArtisteDTO;

    public function putSpectacle(SpectacleCreerDTO $spectacleDTO) : void;
}