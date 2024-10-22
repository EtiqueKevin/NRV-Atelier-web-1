<?php

namespace nrv\core\services\spectacle;

interface SpectacleServiceInterface
{
    public function getAllSpectacles();

    public function getSpectacles($date, $style, $lieu);

    public function getSpectacleById($id);

    public function getArtistesBySpectacle($idSpectacle);

    public function getArtisteById($idArtiste);


}