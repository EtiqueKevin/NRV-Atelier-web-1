<?php

namespace nrv\core\services\soiree;

interface SoireeServiceInterface{
    public function getSoireeById($id);

    public function getSoireeDetail($idSoiree);

    public function getSpectacleByIdSoiree($idSoiree);

    public function getLieux();
}