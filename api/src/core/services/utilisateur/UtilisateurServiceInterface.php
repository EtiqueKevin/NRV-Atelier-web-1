<?php

namespace nrv\core\services\utilisateur;

use nrv\core\dto\utilisateur\UtilisateurDTO;
use nrv\core\dto\utilisateur\UtilisateurInputCreationDTO;
use nrv\core\dto\utilisateur\UtilisateurOutputDTO;

interface UtilisateurServiceInterface{

    public function createUtilisateur(UtilisateurInputCreationDTO $utiInputCreDTO):void;

    public function getUtilisateurById(string $id):UtilisateurDTO;

}