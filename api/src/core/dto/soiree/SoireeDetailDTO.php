<?php

namespace nrv\core\dto\soiree;

use DateTime;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\dto\artiste\ArtisteDTO;
use nrv\core\dto\DTO;
use nrv\core\dto\spectacle\SpectacleDTO;
use PhpParser\Node\Expr\Variable;

class SoireeDetailDTO extends DTO{

    private string $id;
    private string $nom;
    private string $thematique;
    private DateTime $date;
    private Lieu $lieu;
    private float $tarif_normal;
    private float $tarif_reduit;
    private array $spectaclesArtistes;


    /**
     * @param $arSoireDetail
     */
    public function __construct($arSoireDetail){
        $soiree = $arSoireDetail['soiree'];
        $this->id = $soiree->ID;
        $this->nom = $soiree->nom;
        $this->thematique = $soiree->thematique;
        $this->date = $soiree->date;
        $this->lieu = $soiree->lieu;
        $this->tarif_normal = $soiree->tarif_normal;
        $this->tarif_reduit = $soiree->tarif_reduit;
        $this->spectaclesArtistes = $arSoireDetail['spectacleDetail'];
    }

    /**
     * TRANSFORME LE DTO EN JSON
     * @return array
     */
    public function jsonSerialize(): array{
        $nbSpectacles = 0;

        $specTab = [];

        foreach ($this->spectaclesArtistes as $specArt){
            $nbSpectacles++;
            $artTab = [];

            $spectacleDTO =new SpectacleDTO($specArt['spectacle']);

            $nbArtiste = 0;


            foreach ($specArt['artistes'] as $art){
                $nbArtiste++;
                $artDTO = new ArtisteDTO($art);
                $artTab[] =[
                    'artiste'.$nbArtiste =>$artDTO->jsonSerialize()
                ];
            }

            $prep[]= [
                'detail' => $spectacleDTO->jsonSerialize(),
                'artistes' => $artTab
            ];

            $specTab[] =[
                'spectacle'.$nbSpectacles =>$prep
            ];

        }

        $resTab[] = [
            'id' => $this->id,
            'nom' => $this->nom,
            'thematique' => $this->thematique,
            'date' => $this->date->format('Y-m-d'),
            'lieu' => $this->lieu->toDTO(),
            'tarif_normal' => $this->tarif_normal,
            'tarif_reduit' => $this->tarif_reduit,
        ];

        $resTab[] = [
            'spectacles'=>$specTab
        ];



        return $resTab;
    }
}