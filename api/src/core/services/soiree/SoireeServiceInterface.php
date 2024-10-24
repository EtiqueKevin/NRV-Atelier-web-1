<?php

namespace nrv\core\services\soiree;

use nrv\core\dto\soiree\SoireeDTO;

interface SoireeServiceInterface{
    public function getSoireeById(string $id): SoireeDTO;

    public function getSoireeDetail(string $idSoiree): SoireeDTO;

    public function getSpectacleByIdSoiree(string $idSoiree): array;

    public function getLieux(): array;
    public function getStyles(): array;
}