<?php

namespace nrv\core\domain\entities\spectacle;

use Faker\Core\DateTime;
use nrv\core\domain\entities\Entity;
use nrv\core\dto\specialite\SpectacleDTO;

class Spectacle extends Entity {

    protected string $titre;

    protected string $description;

    protected DateTime $heure;

    protected string $url_video;

    public function __construct(string $titre, string $desc, DateTime $h, string $url_video){
        $this->titre = $titre;
        $this->description = $desc;
        $this->heure = $h;
        $this->url_video = $url_video;
    }

    public function toDTO():SpectacleDTO{
        return new SpectacleDTO($this);
    }
}