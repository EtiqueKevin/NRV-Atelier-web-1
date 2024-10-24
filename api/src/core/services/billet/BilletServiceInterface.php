<?php

namespace nrv\core\services\billet;

use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\billet\BilletDTO;
use nrv\core\dto\billet\BilletInputDTO;
use nrv\core\dto\billet\BilletOutputDTO;

interface BilletServiceInterface{

    public function getBilletsByIdUtilisateur(string $id): BilletOutputDTO;

    public function getBilletById(BilletInputDTO $biInputDTO): BilletDTO;

    public function payerCommande(string $idUser);

}