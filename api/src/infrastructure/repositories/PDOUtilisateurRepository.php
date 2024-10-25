<?php

namespace nrv\infrastructure\repositories;

use DateTime;
use nrv\core\domain\entities\billet\Billet;
use nrv\core\domain\entities\Panier\Panier;
use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use nrv\core\services\utilisateur\UtilisateurException;
use PDO;
use Ramsey\Uuid\Uuid;

class PDOUtilisateurRepository implements UtilisateursRepositoryInterface{

    private \PDO $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }


    /**
     * RECUPERE UN UTILISATEUR PAR SON EMAIL
     * @param string $email
     * @return Utilisateur
     * @throws RepositoryEntityNotFoundException
     * @throws RepositoryException
     */
    public function UtilisateurByEmail(string $email): Utilisateur{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $utilisateur = $stmt->fetch();

            if(!$utilisateur){
                throw new RepositoryEntityNotFoundException('utilisateur inconnue');
            }

            $utilisateurEntity = new Utilisateur($utilisateur['nom'],$utilisateur['prenom'],$utilisateur['email'],$utilisateur['mdp'],$utilisateur['role']);
            $utilisateurEntity->setID($utilisateur['id']);
        }catch (RepositoryEntityNotFoundException $e) {
            throw new RepositoryEntityNotFoundException('utilisateur inconnue');
        }catch (\Exception $e){
            throw new RepositoryException('UtilisateurByEmail : erreur lors du chargemement utilisateur '.$e->getMessage());
        }
        return $utilisateurEntity;
    }


    /**
     * RECUPERE UN UTILISATEUR PAR SON ID
     * @param string $id
     * @return Utilisateur
     * @throws RepositoryEntityNotFoundException
     * @throws RepositoryException
     */
    public function UtilisateurById(string $id): Utilisateur{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $utilisateur = $stmt->fetch();

            if(!$utilisateur){
                throw new RepositoryEntityNotFoundException('utilisateur inconnue');
            }

            $utilisateurEntity = new Utilisateur($utilisateur['nom'],$utilisateur['prenom'],$utilisateur['email'],$utilisateur['mdp'],$utilisateur['role']);
            $utilisateurEntity->setID($utilisateur['id']);
        }catch (RepositoryEntityNotFoundException $e) {
            throw new RepositoryEntityNotFoundException('utilisateur inconnue');
        }catch (\Exception $e){
            throw new RepositoryException('UtilisateurByEmail : erreur lors du chargemement utilisateur '.$e->getMessage());
        }
        return $utilisateurEntity;
    }


    /**
     * RECUPERE UN PANIER PAR RAPPORT A L'ID DE L'UTILISATEUR
     * @param string $idUser
     * @return Panier
     * @throws RepositoryException
     */
    public function getPanier(string $idUser) : Panier
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM paniers_utilisateurs WHERE id_utilisateur = ?');
            $stmt->bindParam(1, $idUser);
            $stmt->execute();
            $panier = $stmt->fetch();
            
            if (!$panier) {
                throw new RepositoryEntityNotFoundException('panier inconnu');
            }
            $panierEntity = new Panier($panier['id_utilisateur'], $panier['id_panier'],$panier['valide']);
            $panierEntity->setID($panier['id']);
        } catch (\Exception $e) {
            throw new RepositoryException('getPanier : erreur lors du chargemement panier '. $idUser ." " . $e->getMessage());
        }
        return $panierEntity;
    }


    /**
     * RECUPERE LES ITEMS DU PANIER PAR RAPPORT A L'ID DU PANIER
     * @param string $idPanier
     * @return array
     * @throws RepositoryException
     */
    public function getPanierItems(string $idPanier) : array
    {
        $panierItemsRes = [];
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM paniers WHERE id_panier = ?');
            $stmt->bindParam(1, $idPanier);
            $stmt->execute();
            $panierItems = $stmt->fetchAll();

            if (!$panierItems) {
                return [];
            }

            foreach ($panierItems as $panierItem) {
                $panierItemEntity = new PanierItem($panierItem['id_soiree'], $panierItem['id_panier'], $panierItem['tarif'],$panierItem['categorie_tarif'], $panierItem['tarif_total'], $panierItem['quantite']);
                $panierItemEntity->setID($panierItem['id']);
                $panierItemsRes[] = $panierItemEntity;
            }

        } catch (\Exception $e) {
            throw new RepositoryException('getPanierItems : erreur lors du chargemement panier'. $idPanier ." " . $e->getMessage());
        }
        return $panierItemsRes;
    }


    /**
     * AJOUTE UN ITEM DANS LE PANIER
     * @param string $idPanier
     * @param string $idSoiree
     * @param int $tarif
     * @param string $typeTarif
     * @param int $qte
     * @return void
     * @throws RepositoryException
     */
    public function addPanier(string $idPanier,string $idSoiree,int $tarif, string $typeTarif, int $qte) : void
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO paniers (id_panier ,id_soiree, tarif, categorie_tarif, quantite) VALUES (?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $idPanier);
            $stmt->bindParam(2, $idSoiree);
            $stmt->bindParam(3, $tarif);
            $stmt->bindParam(4, $typeTarif);
            $stmt->bindParam(5, $qte);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('addPanier : erreur lors de l\'ajout au panier '. $idPanier ." " . $e->getMessage());
        }
    }


    /**
     * MET A JOUR UN ITEM DU PANIER
     * @param PanierItem $panierItem
     * @return void
     * @throws RepositoryException
     */
    public function updatePanier(PanierItem $panierItem) : void{
        try {
            $stmt = $this->pdo->prepare('UPDATE paniers SET quantite = ? WHERE id_panier = ? AND id_soiree = ? AND categorie_tarif = ?');
            $qte = $panierItem->qte;
            $idPanier = $panierItem->idPanier;
            $idSoiree = $panierItem->idSoiree;
            $tarif = $panierItem->typeTarif;
            $stmt->bindParam(1, $qte);
            $stmt->bindParam(2, $idPanier);
            $stmt->bindParam(3, $idSoiree);
            $stmt->bindParam(4, $tarif);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('updatePanier : erreur lors de la mise à jour du panier '. $panierItem->idPanier ." " . $e->getMessage());
        }
    }

    /**
     * CREE UN UTILISATEUR
     * @param Utilisateur $uti
     * @return string
     * @throws RepositoryException
     * @throws UtilisateurException
     */
    public function saveUtilisateur(Utilisateur $uti): string{
        $nom = $uti->nom;
        $prenom = $uti->prenom;
        $email = $uti->email;
        $mdp = $uti->mdp;
        $role = $uti->role;

        try {
            $stmt = $this->pdo->prepare('INSERT INTO utilisateurs (nom, prenom, email, mdp,role) VALUES (?, ?, ?, ?, ?) RETURNING id');
            $stmt->bindParam(1, $nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $prenom, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $mdp, PDO::PARAM_STR);
            $stmt->bindParam(5, $role, PDO::PARAM_STR);
            $stmt->execute();
            $id = $stmt->fetchColumn();
        }catch (\Exception $e){
            throw new UtilisateurException('erreur insertion utilisateur : '.$e->getMessage());
        }

        $this->ajouterPanierUtilisateur($id);

        return $id;
    }


    /**
     * RECUPERE LES BILLETS D'UN UTILISATEUR
     * @param string $id
     * @return array
     */
    public function getBilletsByIdUtilisateur(string $id):array{

        $stmt = $this->pdo->prepare('SELECT * FROM billets WHERE id_utilisateur = ?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $billets = $stmt->fetchAll();

        $billetTab=[];

        foreach ($billets as $b){
            $billetEnity = new Billet($id, $b['id_soiree'], DateTime::createFromFormat('Y-m-d H:i:s',$b['date_heure_soiree']), $b['categorie_tarif']);
            $billetEnity->setID($b['id']);
            $billetTab[] = $billetEnity;
        }

        return $billetTab;
    }

    /**
     * VALIDE UN PANIER
     * @param string $idUser
     * @return void
     * @throws RepositoryException
     */
    public function validerPanier(string $idUser): void{
        try {
            $stmt = $this->pdo->prepare('UPDATE paniers_utilisateurs SET valide = TRUE WHERE id_utilisateur = ?');
            $stmt->bindParam(1, $idUser);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('validerPanier : erreur lors de la validation du panier '. $idUser ." " . $e->getMessage());
        }
    }


    /**
     * AJOUTE UN PANIER A UN UTILISATEUR
     * @param string $id
     * @return void
     * @throws RepositoryException
     */
    public function ajouterPanierUtilisateur(string $id){
        try {
            $stmt = $this->pdo->prepare('INSERT INTO paniers_utilisateurs (id_utilisateur) VALUES (?)');
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('ajouterPanierUtilisateur : erreur creation panier'. $id ." " . $e->getMessage());
        }
    }


    /**
     * RECUPERE UN PANIER PAR RAPPORT A SON ID
     * @param string $id
     * @return Billet
     * @throws RepositoryException
     */
    public function getBilletById(string $id): Billet{
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM billets WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('getBilletById : erreur lors du chargement du biller : '. $id ." " . $e->getMessage());
        }
        $billet = $stmt->fetch();
        $billetEntity = new Billet($billet['id_utilisateur'],$billet['id_soiree'], DateTime::createFromFormat('Y-m-d H:i:s',$billet['date_heure_soiree']), $billet['categorie_tarif']);
        $billetEntity->setID($billet['id']);
        return $billetEntity;
    }


    /**
     * RECUPERE LE NOMBRE DE BILLET PAR RAPPORT A L'ID DE LA SOIREE
     * @param string $id
     * @return int
     * @throws RepositoryException
     */
    public function getNbBilletByIdSoiree(string $id): int{
        try {
            $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM billets WHERE id_soiree = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();

        } catch (\Exception $e) {
            throw new RepositoryException('getNbBilletByIdSoiree : erreur lors du chargement du biller : id soiree : '. $id ." " . $e->getMessage());
        }
        $nb = $stmt->fetch();
        return $nb['count'];
    }


    /**
     * RECUPERE LE ROLE D'UN UTILISATEUR
     * @param string $id
     * @return int
     * @throws RepositoryException
     */
    public function getRole(string $id): int{
        try {
            $stmt = $this->pdo->prepare('SELECT role FROM utilisateurs WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('getRole : erreur lors du chargement du role : '. $id ." " . $e->getMessage());
        }
        $role = $stmt->fetch();
        return $role;
    }


    /**
     * AJOUTE DES BILLETS DANS LA BASE DE DONNEES ET RELIE A L'UTILISATEUR
     * @param string $insertions
     * @return void
     * @throws RepositoryException
     */
    public function addBillets(string $insertions): void
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO billets (id_utilisateur, id_soiree, date_heure_soiree, categorie_tarif) VALUES ' . $insertions);
            $stmt->execute();
        }catch (\Exception $e){
            throw new RepositoryException('addBillets : erreur lors de l\'ajout des billets : ' . $e->getMessage());
        }
    }

    /**
     * VIDE LE PANIER
     * @param string $idPanier
     * @return void
     * @throws RepositoryException
     */
    public function viderPanier(string $idPanier): void{
        try {
            $id = $idPanier;

            $stmt = $this->pdo->prepare('DELETE FROM paniers WHERE id_panier = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt = $this->pdo->prepare('UPDATE paniers_utilisateurs SET valide = FALSE WHERE id_panier = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('viderPanier : erreur lors de la suppression du panier '. $id ." " . $e->getMessage());
        }
    }


    /**
     * SUPPRIME UN ITEM DU PANIER
     * @param PanierItem $panierItem
     * @return void
     * @throws RepositoryException
     */
    public function deletePanierItem(PanierItem $panierItem): void{
        $id_soiree = $panierItem->idSoiree;
        $categorie_tarif = $panierItem->typeTarif;
        $id_panier = $panierItem->idPanier;
        try {
            $stmt = $this->pdo->prepare('DELETE FROM paniers WHERE id_soiree = ? AND categorie_tarif = ? AND id_panier = ?');
            $stmt->bindParam(1, $id_soiree);
            $stmt->bindParam(2, $categorie_tarif);
            $stmt->bindParam(3, $id_panier);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('deletePanierItem : erreur lors de la suppression de l\'item'. $panierItem->idSoiree .' du panier '. $panierItem->idPanier ." " . $e->getMessage());
        }
    }
}