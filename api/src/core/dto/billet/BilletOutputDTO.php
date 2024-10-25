<?php

namespace nrv\core\dto\billet;

use DateTime;
use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\DTO;

class BilletOutputDTO extends DTO{

    protected array $billets;

    /**
     * @param array $bs
     */
    public function __construct(array $bs){
        $this->billets = $bs;
    }

    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array{

        $tab = [];

        foreach ($this->billets as $b){
            $tab[] = $b->toDTO();
        }

        return $tab;
    }

}