<?php

namespace nrv\core\dto\soiree;

use nrv\core\dto\DTO;

class SoireeCreerDTO extends DTO
{
    protected string $nom;
    protected string $thematique;
    protected string $date;
    protected string $lieu;
    protected float $tarif_normal;
    protected float $tarif_reduit;

    public function __construct($nom, $thematique, $date, $lieu, $tarif_normal, $tarif_reduit)
    {
        $this->nom = $nom;
        $this->thematique = $thematique;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->tarif_normal = $tarif_normal;
        $this->tarif_reduit = $tarif_reduit;
    }


    public function jsonSerialize(): array
    {
        return [
            'nom' => $this->nom,
            'thematique' => $this->thematique,
            'date' => $this->date,
            'lieu' => $this->lieu,
            'tarif_normal' => $this->tarif_normal,
            'tarif_reduit' => $this->tarif_reduit
        ];
    }
}