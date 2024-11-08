<?php

namespace nrv\infrastructure\repositories;

use _PHPStan_c875e8309\Nette\Neon\Entity;
use DateTime;
use nrv\core\domain\entities\artiste\Artiste;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\domain\entities\soiree\Soiree;
use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\services\utilisateur\UtilisateurException;
use PDO;
use PHPUnit\Exception;

class PDOSoireeRepository implements SoireesRepositoryInterface{

    private \PDO $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    /**
     * RECUPERE TOUS LES SPECTACLES
     * @param array $date
     * @param array $style
     * @param array $lieu
     * @return array
     * @throws RepositoryException
     */
    public function getAllSpectacles(array $date, array $style, array $lieu): array {
        $sql = 'SELECT * FROM spectacles 
                INNER JOIN soirees_spectacles ON spectacles.id = id_spectacle 
                INNER JOIN soirees ON id_soiree = soirees.id 
                WHERE 1=1 ';
        
        $params = [];
        
        if (!empty($date)) {
            $placeholders = implode(',', array_fill(0, count($date), '?'));
            $sql .= "AND date IN (" . $placeholders . ")";
            $params = array_merge($params, $date);
        }
        
        if (!empty($style)) {
            $placeholders = implode(',', array_fill(0, count($style), '?'));
            $sql .= "AND thematique IN (" . $placeholders . ")";
            $params = array_merge($params, $style);
        }
        
        if (!empty($lieu)) {
            $placeholders = implode(',', array_fill(0, count($lieu), '?'));
            $sql .= "AND id_lieu IN (" . $placeholders . ")";
            $params = array_merge($params, $lieu);
        }
                
        // Préparation de la requête
        $stmt = $this->pdo->prepare($sql);
        
        // Exécution avec les autres paramètres
        $stmt->execute($params); // Executez maintenant avec tous les paramètres
    
        $spectacles = $stmt->fetchAll();
        $specTab = [];
        
        try {
            foreach ($spectacles as $spe) {
                $specEntity = $this->getSpectacleById($spe['id_spectacle']);
                $specTab[] = $specEntity;
            }
        } catch (\Exception $e) {
            throw new RepositoryException('erreur lors du get des spectacles avec filtres : ' . $e->getMessage());
        }
        
        return $specTab;
    }


    /**
     * RECUPERE LES SPECTACLES PAR RAPPORT A DES FILTRES ET UNE PAGE DONNEE, LES IL Y A PLUSIEURS DATES, PLUSIEURS STYLES,
     * PLUSIEURS LIEUX COMME FILTRES ET ILS SONT TOUS INDEPENDANTS ET OPTIONNELS
     * @param array $date
     * @param array $style
     * @param array $lieu
     * @param int $page
     * @return array
     * @throws RepositoryException
     */
    public function getSpectacles(array $date, array $style, array $lieu, int $page): array {
        $sql = 'SELECT * FROM spectacles 
                INNER JOIN soirees_spectacles ON spectacles.id = id_spectacle 
                INNER JOIN soirees ON id_soiree = soirees.id 
                WHERE 1=1 ';
        
        $params = [];
        
        if (!empty($date)) {
            $placeholders = implode(',', array_fill(0, count($date), '?'));
            $sql .= "AND date IN (" . $placeholders . ")";
            $params = array_merge($params, $date);
        }
        
        if (!empty($style)) {
            $placeholders = implode(',', array_fill(0, count($style), '?'));
            $sql .= "AND thematique IN (" . $placeholders . ")";
            $params = array_merge($params, $style);
        }
        
        if (!empty($lieu)) {
            $placeholders = implode(',', array_fill(0, count($lieu), '?'));
            $sql .= "AND id_lieu IN (" . $placeholders . ")";
            $params = array_merge($params, $lieu);
        }
        
        // Calcul de l'offset
        $offset = ($page - 1) * 12; // 12 spectacles par page
        $sql .= " LIMIT 12 OFFSET ?"; // Ajout du LIMIT et OFFSET
        
        // Préparation de la requête
        $stmt = $this->pdo->prepare($sql);
        
        // Ajoutez l'offset aux paramètres
        $params[] = $offset; // Ajouter l'offset aux paramètres positionnels
        
        // Exécution avec les autres paramètres
        $stmt->execute($params); // Executez maintenant avec tous les paramètres
    
        $spectacles = $stmt->fetchAll();
        $specTab = [];
        
        try {
            foreach ($spectacles as $spe) {
                $specEntity = $this->getSpectacleById($spe['id_spectacle']);
                $specTab[] = $specEntity;
            }
        } catch (\Exception $e) {
            throw new RepositoryException('erreur lors du get des spectacles avec filtres : ' . $e->getMessage());
        }
        
        return $specTab;
    }


    /**
     * RECUPERE UN SPECTACLE PAR RAPPORT A SON ID
     * @param string $id
     * @return Spectacle
     * @throws RepositoryException
     */
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


    /**
     *RECUPERE LES SPECTACLES PAR RAPPORT A L'ID D'UNE SOIREE
     * @param string $idSoiree
     * @return array
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE L'ID D'UNE SOIREE PAR RAPPORT A L'ID D'UN SPECTACLE
     * @param string $idSpec
     * @return string
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE UNE SOIREE PAR RAPPORT A SON ID
     * @param string $id
     * @return Soiree
     * @throws RepositoryEntityNotFoundException
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE UNE SOIREE PAR RAPPORT A SON ID AVEC LES DETAILS
     * @param string $id
     * @return array
     * @throws RepositoryEntityNotFoundException
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE UN ARTISTE PAR RAPPORT A SON ID
     * @param string $id
     * @return Artiste
     * @throws RepositoryEntityNotFoundException
     */
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


    /**
     * RECUPERE LES ID DES ARTISTES PAR RAPPORT A L'ID D'UN SPECTACLE
     * @param string $idSpec
     * @return array
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE UN LIEU PAR RAPPORT A SON ID
     * @param string $id
     * @return Lieu
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE TOUS LES LIEUX
     * @return array
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE LES IMAGES PAR RAPPORT A L'ID D'UN SPECTACLE
     * @param string $specId
     * @return array
     * @throws RepositoryException
     */
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


    /**
     * RECUPERE TOUS LES STYLES
     * @return array
     * @throws RepositoryException
     */
    public function getStyles() : array {
        try {
            $stmt = $this->pdo->prepare('SELECT DISTINCT thematique FROM soirees');
            $stmt->execute();
            $styles = $stmt->fetchAll();
            if(!$styles){
                throw new RepositoryEntityNotFoundException('pas de style trouvé');
            }
            $tabStyle = [];
            foreach ($styles as $style){
                $tabStyle[] = $style['thematique'];
            }
            return $tabStyle;
        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des styles : '. $e->getMessage());
        }
    }


    /**
     * RECUPERE UN LIEU PAR RAPPORT A L'ID D'UNE SOIREE
     * @param string $idSoiee
     * @return string
     * @throws RepositoryException
     */
    public function getIdLieuByIdSoiree(string $idSoiee): string{
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM soirees WHERE id = ?');
            $stmt->bindParam(1, $idSoiee, \PDO::PARAM_STR);
            $stmt->execute();
            $soireeRes = $stmt->fetch();
            if(!$soireeRes){
                throw new RepositoryEntityNotFoundException('getNbPlaceByIdSoiee : pas place trouvé pour spectacle : ' . $idSoiee );
            }
        }catch (\Exception $e){
            throw new RepositoryException('getIdLieuByIdSoiree : erreur lors du chargement des lieux : '. $e->getMessage() );
        }
        return $soireeRes['id_lieu'];
    }

    /**
     * RECUPERE LE NOMBRE DE PLACES PAR RAPPORT A L'ID D'UNE SOIREE
     * @param string $idSoiee
     * @return int
     * @throws RepositoryException
     */
    public function getNbPlaceByIdSoiee(string $idSoiee): int{
        try {
            $idLieu = $this->getIdLieuByIdSoiree($idSoiee);
            $lieuEntity = $this->getLieuById($idLieu);
            $nbPlacett = $lieuEntity->places_assise + $lieuEntity->places_debout;
            return $nbPlacett;
        }catch (\Exception $e){
            throw new RepositoryException('getNbPlaceByIdSoiee : erreur lors du chargement des places lieu : '. $e->getMessage() );
        }
    }


    /**
     * CREE UN SPECTACLE
     * @param Spectacle $spectacle
     * @return Spectacle
     * @throws UtilisateurException
     */
    public function saveSpectacle(Spectacle $spectacle): Spectacle{
        $titre = $spectacle->titre;
        $description = $spectacle->description;
        $heure = $spectacle->heure->format('H:i:s');
        $url_video = $spectacle->url_video;
        $imgs = $spectacle->imgs;
        $artistes = $spectacle->artistes;
        $idSoiree = $spectacle->idSoiree;

        try {
            $stmt = $this->pdo->prepare('INSERT INTO spectacles (titre, description, heure,url_video) VALUES (?, ?, ?, ?) RETURNING id');
            $stmt->bindParam(1, $titre, PDO::PARAM_STR);
            $stmt->bindParam(2, $description, PDO::PARAM_STR);
            $stmt->bindParam(3, $heure, PDO::PARAM_STR);
            $stmt->bindParam(4, $url_video, PDO::PARAM_STR);
            $stmt->execute();
            $idSpec = $stmt->fetchColumn();

            $this->liaisonImageSpectacle($imgs,$idSpec);
            $this->liaisonArtisteSpectacle($artistes,$idSpec);
            $this->liaisonSoireeSpectacle($idSoiree,$idSpec);

        }catch (\Exception $e){
            throw new UtilisateurException('erreur insertion spectacle : '.$e->getMessage());
        }

        $specEntity = new Spectacle($titre,$description,\DateTime::createFromFormat('H:i:s',$heure),$url_video,$imgs);
        $specEntity->setID($idSpec);
        return $specEntity;
    }


    /**
     * CREE UNE SOIREE
     * @param Soiree $soiree
     * @return void
     * @throws UtilisateurException
     */
    public function saveSoiree(Soiree $soiree): void
    {
        $nom = $soiree->nom;
        $thematique = $soiree->thematique;
        $date = $soiree->date->format('Y-m-d');
        $lieu = $soiree->lieu->ID;
        $tarif_normal = $soiree->tarif_normal;
        $tarif_reduit = $soiree->tarif_reduit;

        try {
            $stmt = $this->pdo->prepare('INSERT INTO soirees (nom, thematique, date, id_lieu, tarif_normal, tarif_reduit) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $thematique, PDO::PARAM_STR);
            $stmt->bindParam(3, $date, PDO::PARAM_STR);
            $stmt->bindParam(4, $lieu, PDO::PARAM_STR);
            $stmt->bindParam(5, $tarif_normal, PDO::PARAM_STR);
            $stmt->bindParam(6, $tarif_reduit, PDO::PARAM_STR);
            $stmt->execute();

        }catch (\Exception $e){
            throw new UtilisateurException('erreur insertion soiree : '.$e->getMessage());
        }

    }


    /**
     * LIE LES IMAGES A UN SPECTACLE
     * @param array $imgs
     * @param string $idSpec
     * @return void
     * @throws UtilisateurException
     */
    public function liaisonImageSpectacle(array $imgs, string $idSpec):void{
        try {

            foreach ($imgs as $i){
                $stmt = $this->pdo->prepare('INSERT INTO img_spectacles (id_spectacle , url_img) VALUES (?, ?)');
                $stmt->bindParam(1, $idSpec, PDO::PARAM_STR);
                $stmt->bindParam(2, $i, PDO::PARAM_STR);
                $stmt->execute();
            }

        }catch (\Exception $e){
            throw new UtilisateurException('erreur insertion image : '.$e->getMessage());
        }
    }


    /**
     * LIE LES ARTISTES A UN SPECTACLE
     * @param array $artistes
     * @param string $idSpec
     * @return void
     * @throws UtilisateurException
     */
    public function liaisonArtisteSpectacle(array $artistes, string $idSpec):void{
        try {

            foreach ($artistes as $a){
                $stmt = $this->pdo->prepare('INSERT INTO artistes_spectacles (id_spectacle , id_artiste) VALUES (?, ?)');
                $stmt->bindParam(1, $idSpec, PDO::PARAM_STR);
                $stmt->bindParam(2, $a, PDO::PARAM_STR);
                $stmt->execute();
            }

        }catch (\Exception $e){
            throw new UtilisateurException('erreur insertion image : '.$e->getMessage());
        }
    }

    /**
     * LIE UN SPECTACLE A UNE SOIREE
     * @param string $idSoiree
     * @param string $spectacles
     * @return void
     * @throws UtilisateurException
     */
    public function liaisonSoireeSpectacle(string $idSoiree, string $spectacles): void {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO soirees_spectacles (id_soiree, id_spectacle) VALUES (?, ?)');
            $stmt->bindParam(1, $idSoiree, PDO::PARAM_STR);
            $stmt->bindParam(2, $spectacles, PDO::PARAM_STR);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new UtilisateurException('erreur insertion soiree_spectacle : ' . $e->getMessage());
        }
    }

    /**
     * RECUPERE TOUS LES ARTISTES
     * @return array
     * @throws RepositoryException
     */
    public function getArtistes(): array{
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM artistes');
            $stmt->execute();
            $artistes = $stmt->fetchAll();
            $artistesTab = [];
            foreach ($artistes as $a){
                $artisteEntity = new Artiste($a['nom'],$a['prenom'],$a['description']);
                $artisteEntity->setID($a['id']);
                $artistesTab[] = $artisteEntity;
            }
        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des lieux : '. $e->getMessage());
        }
        return $artistesTab;
    }


    /**
     * RECUPERE TOUTES LES SOIREES
     * @return array
     * @throws RepositoryException
     */
    public function getSoirees(): array{
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM soirees');
            $stmt->execute();
            $soirees = $stmt->fetchAll();
            $soireesTab = [];
            foreach ($soirees as $s){
                $lieuEntity = $this->getLieuById($s['id_lieu']);
                $soireeEntity = new Soiree($s['nom'],$s['thematique'], DateTime::createFromFormat('Y-m-d', $s['date']),$lieuEntity,$s['tarif_normal'],$s['tarif_reduit']);
                $soireeEntity->setID($s['id']);
                $soireesTab[] = $soireeEntity;
            }
        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des lieux : '. $e->getMessage());
        }
        return $soireesTab;
    }
}