<?php

namespace nrv\core\services\artiste;

use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\dto\artiste\ArtisteOutputDTO;

class ArtisteService implements ArtisteServiceInterface {

   private SoireesRepositoryInterface $soireesRepository;

    public function __construct(SoireesRepositoryInterface$soireesRepository){
        $this->soireesRepository = $soireesRepository;
    }

    public function getArtistes(): ArtisteOutputDTO{
        $artistes = $this->soireesRepository->getArtistes();

        $artisteDTO = [];

        foreach ($artistes as $a){
            $artisteDTO[] = $a->toDTO();
        }

        return new ArtisteOutputDTO($artisteDTO);
    }

}