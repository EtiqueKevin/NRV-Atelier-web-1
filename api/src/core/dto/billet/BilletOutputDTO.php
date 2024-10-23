<?php

namespace nrv\core\dto\billet;

use DateTime;
use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\DTO;

class BilletOutputDTO extends DTO{

    protected array $billets;

    public function __construct(array $bs){
        $this->billets = $bs;
    }

    public function jsonSerialize(): array{

        $tab = [];

        foreach ($this->billets as $b){
            $tab[] = $b->toDTO();
        }

        return $tab;
    }

}