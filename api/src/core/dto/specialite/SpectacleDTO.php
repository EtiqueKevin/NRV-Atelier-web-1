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
        $this->id = $spectacle->getId();
        $this->titre = $spectacle->getTitre();
        $this->description = $spectacle->getDescription();
        $this->heure = $spectacle->getHeure();
        $this->urlVideo = $spectacle->getUrlVideo();
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