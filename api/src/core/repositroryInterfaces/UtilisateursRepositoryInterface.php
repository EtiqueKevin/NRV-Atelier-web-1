<?php

namespace nrv\core\repositroryInterfaces;

use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\utilisateur\UtilisateurInputCreationSaveDTO;

interface UtilisateursRepositoryInterface{

    public function UtilisateurByEmail(string $email);

    public function getPanier($idUser);

    public function saveUtilisateur(Utilisateur $uti):string;
}