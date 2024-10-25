<?php

namespace nrv\core\domain\entities\spectacle;


use nrv\core\domain\entities\Entity;
use nrv\core\dto\spectacle\SpectacleDTO;


class Spectacle extends Entity {

    protected string $titre;

    protected string $description;

    protected \DateTime $heure;

    protected string $url_video;

    protected ?string $idSoiree;

    protected array $imgs;

    protected ?array $artistes;


    /**
     * @param string $titre
     * @param string $desc
     * @param \DateTime $h
     * @param string $url_video
     * @param array $imgs
     */
    public function __construct(string $titre, string $desc, \DateTime $h, string $url_video, array $imgs){
        $this->titre = $titre;
        $this->description = $desc;
        $this->heure = $h;
        $this->url_video = $url_video;
        $this->imgs =$imgs;
    }

    /**
     * SETTER DE L'ID DE LA SOIREE
     * @param $ids
     * @return void
     */
    public function setIdSoiree($ids){
        $this->idSoiree = $ids;
    }

    /**
     * SETTER DES ARTISTES
     * @param array $artistes
     * @return void
     */
    public function setArtistes(array $artistes){
        $this->artistes = $artistes;
    }

    /**
     * TRANSFORME L'ENTITY EN DTO
     * @return SpectacleDTO
     */
    public function toDTO():SpectacleDTO{
        return new SpectacleDTO($this);
    }
}