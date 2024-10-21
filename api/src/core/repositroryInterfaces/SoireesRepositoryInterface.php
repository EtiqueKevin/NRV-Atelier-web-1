<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\domain\entities\soiree\Soiree;

interface SoireesRepositoryInterface{

    public function getAllSpectacles(): array;

    public function getSpectacleByIdSoiree($idSoiree): array;

    public function getSoireeById($id): Soiree;

    public function getLieuById($id): Lieu;
}