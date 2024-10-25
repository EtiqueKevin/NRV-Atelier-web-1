<?php

namespace nrv\core\dto\billet;

use DateTime;
use nrv\core\domain\entities\billet\Billet;
use nrv\core\dto\DTO;

class BilletDTO extends DTO{

    protected string $id;
    protected string $id_utilisateur;
    protected string $id_soiree;
    protected DateTime $dateDebut;
    protected string $categorie_tarif;

    protected string $nomSoiree;

    /**
     * @param Billet $b
     */
    public function __construct(Billet $b){
        $this->id_utilisateur = $b->id_utilisateur;
        $this->id_soiree = $b->id_soiree;
        $this->dateDebut = $b->dateDebut;
        $this->categorie_tarif = $b->categorie_tarif;
        $this->id = $b->ID;
        $this->nomSoiree = $b->nomSoiree;
    }

    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array{
        return [
            'id' => $this->id,
            'id_utilisateur' => $this->id_utilisateur,
            'id_soiree' => $this->id_soiree,
            'dateDebut' => $this->dateDebut->format('Y-m-d H:i:s'),
            'categorie_tarif' => $this->categorie_tarif,
            'nomSoiree' => $this->nomSoiree
        ];
    }

}