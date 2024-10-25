<?php

namespace nrv\core\dto\soiree;

use DateTime;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class SoireesDTO extends DTO{
    private array $soirees;

    public function __construct(array $soirees){
        $this->soirees = $soirees;
    }

    public function jsonSerialize(): array
    {
        $tab = [];

        foreach ($this->soirees as $s){
            $tab[] = $s->toDTO();
        }
        return $tab;
    }
}