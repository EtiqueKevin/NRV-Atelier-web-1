<?php

namespace nrv\infrastructure\repositories;

use DateTime;
use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\domain\entities\lieu\Lieu;
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

    //getSpectacles
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
                $specEntity = $this->getSpectacleById($spe['id']);
                $specTab[]=$specEntity;
            }
            return $specTab;

        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement de la collection AllSpectacle : '. $e->getMessage());
        }
    }

    public function getSpectacles($date, $style, $lieu): array{
        //le 1=1 c'est pour que je puisse mettre AND au début de chaque condition
        $sql = 'SELECT * FROM spectacles inner join soirees_spectacles on spectacles.id = id_spectacle inner join soirees on id_soiree = soirees.id  WHERE 1=1 ';
        $params = [];
        if(!empty($date)){
            $placeholders = implode(',', array_fill(0, count($date), '?'));
            $sql .= "AND date IN (" . $placeholders . ")";
            $params = array_merge($params, $date);
        }
        if(!empty($style)){
            $placeholders = implode(',', array_fill(0, count($style), '?'));
            $sql .= "AND thematique IN (" . $placeholders . ")";
            $params = array_merge($params, $style);
        }
        if(!empty($lieu)){
            $placeholders = implode(',', array_fill(0, count($lieu), '?'));
            $sql .= "AND id_lieu IN (" . $placeholders . ")";
            $params = array_merge($params, $lieu);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $spectacles = $stmt->fetchAll();
        $specTab = [];
        try{
            foreach ($spectacles as $spe){
                $specEntity = $this->getSpectacleById($spe['id_spectacle']);
                $specTab[]=$specEntity;
            }
        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du get des spectacles avec filtres : '. $e->getMessage());
        }
        return $specTab;
    }

    public function getSpectacleById(string $id) : Spectacle{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles WHERE id = ?');
            $stmt->bindParam(1, $id, \PDO::PARAM_STR);
            $stmt->execute();
            $spectacle = $stmt->fetch();
            if(!$spectacle){
                throw new RepositoryEntityNotFoundException('pas de $spectacle trouvé');
            }
            $idsoiree = $this->getSoireeIdByIdSpectacle($spectacle['id']);

            $soiree = $this->getSoireeById($idsoiree);

            list($h, $m, $s) = explode(':', $spectacle['heure']);

            $dateRes = $soiree->date;

            $dateRes->setTime((int)$h,(int)$m,(int)$s);

            $imgs = $this->getImageBySpectacleId($spectacle['id']);

            $specEntity = new Spectacle($spectacle['titre'],$spectacle['description'],$dateRes,$spectacle['url_video'],$imgs);
            $specEntity->setID($spectacle['id']);
            $specEntity->setIdSoiree($idsoiree);
        }catch (\Exception $e){
            throw new RepositoryException('getSpectacleById : erreur lors du chargement du spectacle '.$id ." ".$e->getMessage());
        }
        return $specEntity;
    }

    public function getSpectacleByIdSoiree(string $idSoiree): array{
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


    //soirées

    public function getSoireeIdByIdSpectacle(string $idSpec): string{
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
            throw new RepositoryException('erreur lors de la liaison entre spectacle et soiree pour l\'id de spectacle'. $idSpec . " " .$e->getMessage());
        }
    }

    public function getSoireeById(string $id): Soiree{
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
            throw new RepositoryException('erreur lors du chargement de la soirée ' . $id . " " . $e->getMessage());
        }
    }

    public function getSoireeByIdDetail(string $id): array{
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

    //artistes

    public function getArtisteById(string $id) : Artiste{
        $stmt = $this->pdo->prepare('SELECT * FROM artistes WHERE id = ?');
        $stmt->bindParam(1, $id, \PDO::PARAM_STR);
        $stmt->execute();
        $artisteRes = $stmt->fetch();
        if(!$artisteRes){
            throw new RepositoryEntityNotFoundException('pas d\' artiste trouvé');
        }
        $artisteEntity = new Artiste($artisteRes['nom'],$artisteRes['prenom'],$artisteRes['description']);
        $artisteEntity->setID($artisteRes['id']);
        return $artisteEntity;
    }

    public function getArtisteIdByIdSpectacle(string $idSpec): array {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles inner join artistes_spectacles ON spectacles.id = artistes_spectacles.id_spectacle WHERE artistes_spectacles.id_spectacle = ?');
            $stmt->bindParam(1,$idSpec, PDO::PARAM_STR);
            $stmt->execute();
            $art_spec = $stmt->fetchAll();
            if(!$art_spec){
                throw new RepositoryEntityNotFoundException('getArtisteIdBySpectacle : pas d\' artiste trouvé pour spectacle : ' . $idSpec );
            }
            $IdArtisteTab = [];

            foreach ($art_spec as $i){
                $IdArtisteTab[] = $i['id_artiste'];
            }

        }catch (\Exception $e){
            throw new RepositoryException('getArtisteIdBySpectacle : erreur lors du chargement de l\'image : '. $e->getMessage());
        }

        return $IdArtisteTab;
    }

    //lieux


    public function getLieuById(string $id): Lieu{
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
            throw new RepositoryException('erreur lors du chargement du lieu '. $id . " " . $e->getMessage());
        }
    }

    public function getLieux(): array{
        try {
            $sql = 'SELECT * FROM lieux';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $lieux = $stmt->fetchAll();
            $lieuxTab = [];
            foreach ($lieux as $lieu){
                $lieuEntity = new Lieu($lieu['nom'],$lieu['adresse'],$lieu['places_assises'],$lieu['places_debout']);
                $lieuEntity->setID($lieu['id']);
                $lieuxTab[] = $lieuEntity;
            }
        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des lieux : '. $e->getMessage());
        }
        return $lieuxTab;
    }

    //images

    public function getImageBySpectacleId(string $specId) :array{

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles inner join img_spectacles ON spectacles.id = img_spectacles.id_spectacle  WHERE img_spectacles.id_spectacle = ?');
            $stmt->bindParam(1, $specId, \PDO::PARAM_STR);
            $stmt->execute();
            $imgRes = $stmt->fetchAll();
            if(!$imgRes){
                throw new RepositoryEntityNotFoundException('getImageBySpectacleId : pas artiste trouvé pour spectacle : ' . $specId );
            }

            $imgTab = [];

            foreach ($imgRes as $i){
                $imgTab[] = 'img/'.$i['url_img'];
            }
        }catch (\Exception $e){
            throw new RepositoryException('getImageBySpectacleId : erreur lors du chargement image : '. $e->getMessage() );
        }
        return $imgTab;
    }
}