<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\domain\entities\soiree\Soiree;

interface UtilisateursRepositoryInterface{

    public function UtilisateurByEmail(string $email);
}