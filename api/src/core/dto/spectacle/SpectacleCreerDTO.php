<?php

namespace nrv\core\dto\spectacle;

use DateTime;
use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\dto\DTO;

class SpectacleCreerDTO extends DTO
{
    protected string $titre;
    protected string $description;
    protected string $heure;
    protected string $url_video;

    protected string $idSoiree;

    protected array $imgs;

    public function __construct(string $titre,string $description,string $heure,string $url_video,string $idSoiree,array $imgs){
        $this->titre =$titre;
        $this->description = $description;
        $this->heure = $heure;
        $this->url_video = $url_video;
        $this->idSoiree = $idSoiree;
        $this->imgs = $imgs;
    }

    public function jsonSerialize(): array{
        return [
            'titre' => $this->titre,
            'description' => $this->description,
            'heure' => $this->heure,
            'urlVideo' => $this->url_video,
            'idSoiree' => $this->idSoiree,
            'imgs' => $this->imgs
        ];
    }

}