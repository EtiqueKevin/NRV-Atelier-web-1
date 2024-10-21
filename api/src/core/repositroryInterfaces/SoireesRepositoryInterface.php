<?php

namespace nrv\core\repositroryInterfaces;

interface SoireesRepositoryInterface{

    public function getAllSpectacles(): array;

    public function getSpectacleByIdSoiree($idSoiree): array;

}