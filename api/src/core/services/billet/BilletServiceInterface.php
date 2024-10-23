<?php

namespace nrv\core\services\billet;

use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\billet\BilletOutputDTO;

interface BilletServiceInterface{

    public function getBilletsByIdUtilisateur($id): BilletOutputDTO;

}