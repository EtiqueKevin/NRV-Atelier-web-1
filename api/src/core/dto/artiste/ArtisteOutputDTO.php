<?php

namespace nrv\core\dto\artiste;

use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\dto\DTO;

class ArtisteOutputDTO extends DTO {

    protected array $artistes;

    public function __construct(array $artistes){
        $this->artistes = $artistes;
    }

    public function jsonSerialize(): array{

        $tab = [];
        foreach ($this->artistes as $a){
            $tab[] = $a;
        }

        return $tab;

    }

}