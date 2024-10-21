<?php

namespace nrv\core\services\spectacle;

use nrv\core\repositroryInterfaces\SpectacleRepositoryInterface;

class SpectacleService implements SpectacleServiceInterface
{
    private SpectacleRepositoryInterface $spectacleRepository;

    public function __construct()
    {

    }

    public function getAllSpectacles() : array
    {
        return $this->spectacleRepository->getAllSpectacles();
    }
}