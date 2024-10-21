<?php

namespace nrv\core\domain\entities\spectacle;

use Faker\Core\DateTime;
use nrv\core\dto\specialite\SpectacleDTO;

class Spectacle{

    protected string $titre;

    protected string $description;

    protected DateTime $heure;

    protected string $url_video;

    public function construct(string $titre, string $desc, DateTime $h, string $url_video){
        $this->titre = $titre;
        $this->description = $desc;
        $this->heure = $h;
        $this->url_video = $url_video;
    }

    public function toDTO():SpectacleDTO{
        return new SpectacleDTO($this);
    }
}