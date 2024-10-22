<?php

namespace nrv\infrastructure\repositories;

use DateTime;
use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\domain\entities\soiree\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use PDO;
use PHPUnit\Exception;

class PDOSoireeRepository implements SoireesRepositoryInterface{

    private \PDO $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getAllSpectacles(): array{
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles');
            $stmt->execute();
            $spectacles = $stmt->fetchAll();
            if( !$spectacles){
                throw new RepositoryEntityNotFoundException('pas de spectacle');
            }
            $specTab = [];
            foreach ($spectacles as $spe){
                $idsoiree = $this->getSoireeIdByIdSpectacle($spe['id']);
                $heure = \DateTime::createFromFormat('H:i:s',$spe['heure']);
                $specEntity = new Spectacle($spe['titre'],$spe['description'],$heure,$spe['url_video']);
                $specEntity->setID($spe['id']);
                $specEntity->setIdSoiree($idsoiree);
                $specTab[]=$specEntity;
            }
            return $specTab;

        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des lists : '. $e->getMessage());
        }
    }

    public function getSoireeIdByIdSpectacle($idSpec): string{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles inner join soirees_spectacles ON spectacles.id = soirees_spectacles.id_spectacle WHERE soirees_spectacles.id_spectacle = ?');
            $stmt->bindParam(1,$idSpec, PDO::PARAM_STR);
            $stmt->execute();
            $idsoireeRes = $stmt->fetch();
            $idsoiree = "";
            if( $idsoireeRes){
                $idsoiree = $idsoireeRes['id_soiree'];
            }
            return $idsoiree;
        }catch (Exception $e){
            throw new RepositoryException('erreur lors de la liaison entre spectacle et soiree' .$e->getMessage());
        }

    }

    public function getSpectacleByIdSoiree($idSoiree): array{
        $stmt = $this->pdo->prepare('SELECT * FROM soirees inner join soirees_spectacles ON soirees.id = soirees_spectacles.id_soiree WHERE soirees_spectacles.id_soiree = ?');
        $stmt->bindParam(1,$idSoiree, PDO::PARAM_STR);
        $stmt->execute();
        $soireeSpectacles = $stmt->fetchAll();
        $specTab = [];
        try{
            foreach ($soireeSpectacles as $sspec){
                $specTab[] = $sspec['id_spectacle'];
            }
        }catch (\Exception $e){
            throw new RepositoryException('getSpectacleByIdSoiree : erreur lors du chargement des spectacles ou de l artiste'.$e->getMessage());
        }
        return $specTab;
    }

    public function getLieuById($id): Lieu{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM lieux WHERE id = ?');
            $stmt->bindParam(1,$id, PDO::PARAM_STR);
            $stmt->execute();
            $lieuRes = $stmt->fetch();
            if (!$lieuRes) {
                throw new RepositoryEntityNotFoundException("lieu non trouvé");
            }
            $lieuEntity = new Lieu($lieuRes['nom'],$lieuRes['adresse'],$lieuRes['places_assises'],$lieuRes['places_debout']);
            $lieuEntity->setID($lieuRes['id']);
            return $lieuEntity;
        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des lieux ' . $e->getMessage());
        }
    }

    public function getSoireeById($id): Soiree{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM soirees WHERE id = ?');
            $stmt->bindParam(1, $id, \PDO::PARAM_STR);
            $stmt->execute();
            $soireeRes = $stmt->fetch();
            if(!$soireeRes){
                throw new RepositoryEntityNotFoundException('pas de soiree trouvé');
            }
            $lieuEntity = $this->getLieuById($soireeRes['id_lieu']);
            $soireeEntity = new Soiree($soireeRes['nom'],$soireeRes['thematique'], DateTime::createFromFormat('Y-m-d', $soireeRes['date']),$lieuEntity,$soireeRes['tarif_normal'],$soireeRes['tarif_reduit']);
            $soireeEntity->setID($soireeRes['id']);
            return $soireeEntity;
        }catch (Exception $e){
            throw new RepositoryException('erreur lors du chargement d une soirée ' . $e->getMessage());
        }
    }

    public function getSpectacleById($id) : Spectacle{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles WHERE id = ?');
            $stmt->bindParam(1, $id, \PDO::PARAM_STR);
            $stmt->execute();
            $spectacle = $stmt->fetch();
            if(!$spectacle){
                throw new RepositoryEntityNotFoundException('pas de soiree trouvé');
            }
            $idsoiree = $this->getSoireeIdByIdSpectacle($spectacle['id']);

            $soiree = $this->getSoireeById($idsoiree);

            list($h, $m, $s) = explode(':', $spectacle['heure']);

            $dateRes = $soiree->date;

            $dateRes->setTime((int)$h,(int)$m,(int)$s);

            $specEntity = new Spectacle($spectacle['titre'],$spectacle['description'],$dateRes,$spectacle['url_video']);
            $specEntity->setID($spectacle['id']);
            $specEntity->setIdSoiree($idsoiree);
        }catch (\Exception $e){
            throw new RepositoryException('getSpectacleById : erreur lors du chargement du spectacle '.$e->getMessage());
        }
        return $specEntity;
    }

    public function getArtisteById($id) : Artiste{
        $stmt = $this->pdo->prepare('SELECT * FROM artistes WHERE id = ?');
        $stmt->bindParam(1, $id, \PDO::PARAM_STR);
        $stmt->execute();
        $artisteRes = $stmt->fetch();
        if(!$artisteRes){
            throw new RepositoryEntityNotFoundException('pas d artiste trouvé');
        }
        $artisteEntity = new Artiste($artisteRes['nom'],$artisteRes['prenom'],$artisteRes['description']);
        $artisteEntity->setID($artisteRes['id']);
        return $artisteEntity;
    }

    public function getArtisteIdByIdSpectacle($idSpec): array {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles inner join artistes_spectacles ON spectacles.id = artistes_spectacles.id_spectacle WHERE artistes_spectacles.id_spectacle = ?');
            $stmt->bindParam(1,$idSpec, PDO::PARAM_STR);
            $stmt->execute();
            $art_spec = $stmt->fetchAll();
            if(!$art_spec){
                throw new RepositoryEntityNotFoundException('getArtisteIdBySpectacle : pas artiste trouvé pour spectacle : ' . $idSpec );
            }
            $IdArtisteTab = [];

            foreach ($art_spec as $i){
                $IdArtisteTab[] = $i['id_artiste'];
            }

        }catch (\Exception $e){
            throw new RepositoryException('getArtisteIdBySpectacle : erreur lors du chargement de image : '. $e->getMessage());
        }

        return $IdArtisteTab;
    }

    public function getSoireeByIdDetail($id): array{
        try {
            $soireeEntity = $this->getSoireeById($id);
            $arraySpectacle = $this->getSpectacleByIdSoiree($id);
        }catch (Exception $e){
            throw new RepositoryException('erreur lors de la récupération d une soirée: '. $e->getMessage());
        }
        return [
            'soiree'=>$soireeEntity,
            'spectacleDetail'=>$arraySpectacle
        ];
    }
}