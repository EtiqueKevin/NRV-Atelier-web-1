<?php

namespace nrv\core\dto\soiree;

use DateTime;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\dto\DTO;

class SoireeDetailBackofficeDTO extends DTO{
    private int $nbPlacett;
    private int $nbPlaceReserve;

    /**
     * @param int $nPt
     * @param int $nPr
     */
    public function __construct(int $nPt,int $nPr){
        $this->nbPlacett =$nPt;
        $this->nbPlaceReserve =$nPr;
    }

    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array{
        return [
            'nbPlacett' => $this->nbPlacett,
            'nbPlaceReserve' => $this->nbPlaceReserve,
        ];
    }
}