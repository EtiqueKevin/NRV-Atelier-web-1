<?php

namespace nrv\core\services\artiste;

use Monolog\Level;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\dto\artiste\ArtisteOutputDTO;
use Psr\Log\LoggerInterface;

class ArtisteService implements ArtisteServiceInterface {

   private SoireesRepositoryInterface $soireesRepository;

    private LoggerInterface $logger;

    /**
     * @param SoireesRepositoryInterface $soireesRepository
     */
    public function __construct(SoireesRepositoryInterface$soireesRepository, LoggerInterface $logger){
        $this->soireesRepository = $soireesRepository;
        $this->logger = $logger;
    }

    /**
     * RECUPERE TOUS LES ARTISTES
     * @return ArtisteOutputDTO
     */
    public function getArtistes(): ArtisteOutputDTO{
        $artistes = $this->soireesRepository->getArtistes();

        $artisteDTO = [];

        foreach ($artistes as $a){
            $artisteDTO[] = $a->toDTO();
        }

        $this->logger->log(Level::Info, "Get Artiste : " . date('Y-m-d H:i:s'));

        return new ArtisteOutputDTO($artisteDTO);
    }

}