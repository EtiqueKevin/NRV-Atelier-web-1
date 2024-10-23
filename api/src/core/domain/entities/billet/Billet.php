<?php

namespace nrv\core\domain\entities\billet;

use DateTime;
use nrv\core\domain\entities\Entity;
use nrv\core\dto\billet\BilletDTO;
use nrv\core\dto\soiree\LieuDTO;
use Respect\Validation\Rules\Date;

class Billet extends Entity{

    protected string $id_utilisateur;
    protected string $id_soiree;
    protected DateTime $dateDebut;
    protected string $categorie_tarif;

    protected ?string $nomSoiree ="";

    public function __construct(string $idU,string $idS,DateTime $dD,string $ct){
        $this->id_utilisateur = $idU;
        $this->id_soiree = $idS;
        $this->dateDebut = $dD;
        $this->categorie_tarif = $ct;
    }

    public function setNomSoiree(string $nom){
        $this->nomSoiree = $nom;
    }

    public function toDTO(): BilletDTO{
        return new BilletDTO($this);
    }

}