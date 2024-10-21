<?php

namespace nrv\core\dto\soiree;

use DateTime;
use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\dto\DTO;

class SoireeDTO extends DTO{
    private string $id;
    private string $nom;
    private string $thematique;
    private DateTime $date;
    private Lieu $lieu;
    private float $tarif_normal;
    private float $tarif_reduit;

    public function __construct($soiree){
        $this->id = $soiree->ID;
        $this->nom = $soiree->nom;
        $this->thematique = $soiree->thematique;
        $this->date = $soiree->date;
        $this->lieu = $soiree->lieu;
        $this->tarif_normal = $soiree->tarif_normal;
        $this->tarif_reduit = $soiree->tarif_reduit;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'thematique' => $this->thematique,
            'date' => $this->date->format('Y-m-d'),
            'lieu' => $this->lieu->toDTO(),
            'tarif_normal' => $this->tarif_normal,
            'tarif_reduit' => $this->tarif_reduit
        ];
    }
}