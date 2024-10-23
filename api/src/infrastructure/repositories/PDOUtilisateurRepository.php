<?php

namespace nrv\infrastructure\repositories;

use nrv\core\domain\entities\Panier\Panier;
use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\Panier\PanierItemDTO;
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

    public function getPanierItems(string $idPanier) : array
    {
        $panierItemsRes = [];
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM paniers WHERE id_panier = ?');
            $stmt->bindParam(1, $idPanier);
            $stmt->execute();
            $panierItems = $stmt->fetchAll();

            if (!$panierItems) {
                throw new RepositoryEntityNotFoundException('panier inconnue');
            }

            foreach ($panierItems as $panierItem) {
                $panierItemEntity = new PanierItem($panierItem['id_soiree'], $panierItem['id_panier'], $panierItem['tarif'], $panierItem['tarif_total'], $panierItem['quantite']);
                $panierItemEntity->setID($panierItem['id']);
                $panierItemsRes[] = $panierItemEntity;
            }

        } catch (\Exception $e) {
            throw new RepositoryException('getPanierItems : erreur lors du chargemement panier '. $idPanier ." " . $e->getMessage());
        }
        return $panierItemsRes;
    }

    public function addPanier(string $idPanier,string $idSoiree,int $tarif,int $qte) : void
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO paniers (id_panier ,id_soiree, tarif, quantite) VALUES (?, ?, ?, ?)');
            $stmt->bindParam(1, $idPanier);
            $stmt->bindParam(2, $idSoiree);
            $stmt->bindParam(3, $tarif);
            $stmt->bindParam(4, $qte);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('addPanier : erreur lors de l\'ajout au panier '. $idPanier ." " . $e->getMessage());
        }
    }

    public function updatePanier( PanierItem $panierItem) : void
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE paniers SET quantite = ? WHERE id_panier = ? AND id_soiree = ? AND tarif = ?');
            $qte = $panierItem->qte;
            $idPanier = $panierItem->idPanier;
            $idSoiree = $panierItem->idSoiree;
            $tarif = $panierItem->tarif;
            $stmt->bindParam(1, $qte);
            $stmt->bindParam(2, $idPanier);
            $stmt->bindParam(3, $idSoiree);
            $stmt->bindParam(4, $tarif);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('updatePanier : erreur lors de la mise à jour du panier '. $panierItem->idPanier ." " . $e->getMessage());
        }
    }

    public function saveUtilisateur(Utilisateur $uti): string{
        $id = Uuid::uuid4()->toString();
        $nom = $uti->nom;
        $prenom = $uti->prenom;
        $email = $uti->email;
        $mdp = $uti->mdp;
        $role = $uti->role;

        try {
            $stmt = $this->pdo->prepare('INSERT INTO utilisateurs (id, nom, prenom, email, mdp,role) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->bindParam(2, $nom, PDO::PARAM_STR);
            $stmt->bindParam(3, $prenom, PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);
            $stmt->bindParam(5, $mdp, PDO::PARAM_STR);
            $stmt->bindParam(6, $role, PDO::PARAM_STR);
            $stmt->execute();
        }catch (\Exception $e){
            throw new UtilisateurException('erreur insertion utilisateur : '.$e->getMessage());
        }


        return $id;
    }
}