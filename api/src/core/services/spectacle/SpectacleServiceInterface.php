<?php

namespace nrv\core\services\spectacle;

interface SpectacleServiceInterface
{
    public function getAllSpectacles();

    public function getSpectacles($date, $style, $lieu);


}