<?php

namespace nrv\core\dto\specialite;

use DateTime;
use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\dto\DTO;

class SpectacleDTO extends DTO
{
    private int $id;
    private string $titre;
    private string $description;
    private DateTime $heure;
    private string $urlVideo;

    public function __construct(Spectacle $spectacle)
    {
        $this->id = $spectacle->id;
        $this->titre = $spectacle->titre;
        $this->description = $spectacle->description;
        $this->heure = $spectacle->heure;
        $this->urlVideo = $spectacle->url_video;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'heure' => $this->heure->format('Y-m-d H:i:s'),
            'urlVideo' => $this->urlVideo
        ];
    }

}