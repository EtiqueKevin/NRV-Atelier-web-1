<?php

namespace nrv\core\domain\entities\soiree;

use DateTime;
use nrv\core\domain\entities\Entity;

class Soiree extends Entity {
    protected string $nom;
    protected string $thematique;
    protected string $adresse;
    protected DateTime $date;
    protected Lieu $lieu;

}