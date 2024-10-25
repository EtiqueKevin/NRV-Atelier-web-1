<?php

namespace nrv\core\services\artiste;

use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\artiste\ArtisteOutputDTO;
use nrv\core\dto\billet\BilletDTO;
use nrv\core\dto\billet\BilletInputDTO;
use nrv\core\dto\billet\BilletOutputDTO;

interface ArtisteServiceInterface{
    public function getArtistes(): ArtisteOutputDTO;
}