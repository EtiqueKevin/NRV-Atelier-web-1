<?php

namespace nrv\core\dto\spectacle;

use DateTime;
use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\dto\DTO;

class SpectacleDTO extends DTO
{
    private string $id;
    private string $titre;
    private string $description;
    private DateTime $heure;
    private string $urlVideo;

    private string $idSoiree;

    private array $imgs;

    /**
     * @param Spectacle $spectacle
     */
    public function __construct(Spectacle $spectacle)
    {
        $this->id = $spectacle->ID;
        $this->titre = $spectacle->titre;
        $this->description = $spectacle->description;
        $this->heure = $spectacle->heure;
        $this->urlVideo = $spectacle->url_video;
        $this->idSoiree = $spectacle->idSoiree;
        $this->imgs = $spectacle->imgs;
    }

    /**
     * GETTER DE L'ID
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'heure' => $this->heure->format('Y-m-d H:i:s'),
            'urlVideo' => $this->urlVideo,
            'idSoiree' => $this->idSoiree,
            'imgs' => $this->imgs
        ];
    }

}