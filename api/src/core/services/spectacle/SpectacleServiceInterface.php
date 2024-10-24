<?php

namespace nrv\core\services\spectacle;

use nrv\core\dto\artiste\ArtisteDTO;
use nrv\core\dto\spectacle\SpectacleDTO;

interface SpectacleServiceInterface
{
    public function getAllSpectacles(): array;

    public function getSpectacles($date, $style, $lieu): array;

    public function getSpectacleById(string $id): SpectacleDTO;

    public function getArtistesBySpectacle(string $idSpectacle): array;

    public function getArtisteById(string $idArtiste): ArtisteDTO;


}