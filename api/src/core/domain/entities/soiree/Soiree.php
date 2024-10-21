<?php

namespace nrv\core\domain\entities\soiree;

use DateTime;
use nrv\core\domain\entities\Entity;
use nrv\core\dto\soiree\SoireeDTO;

class Soiree extends Entity {

    protected string $nom;
    protected string $thematique;

    protected DateTime $date;

    protected Lieu $lieu;

    protected float $tarif_normal;

    protected float $tarif_reduit;

    public function __construct(string $n, string $them, DateTime $date, Lieu $lieu, float $tn, float $tr){
        $this->nom = $n;
        $this->thematique = $them;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->tarif_normal = $tn;
        $this->tarif_reduit = $tr;
    }

    public function toDTO(): SoireeDTO{
        return new SoireeDTO($this);
    }


}