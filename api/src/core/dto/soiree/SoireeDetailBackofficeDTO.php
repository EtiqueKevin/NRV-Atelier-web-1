<?php

namespace nrv\core\dto\soiree;

use DateTime;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class SoireeDetailBackofficeDTO extends DTO{
    private int $nbPlacett;
    private int $nbPlaceReserve;

    public function __construct(int $nPt,int $nPr){
        $this->nbPlacett =$nPt;
        $this->nbPlaceReserve =$nPr;
    }

    public function jsonSerialize(): array{
        return [
            'nbPlacett' => $this->nbPlacett,
            'nbPlaceReserve' => $this->nbPlaceReserve,
        ];
    }
}