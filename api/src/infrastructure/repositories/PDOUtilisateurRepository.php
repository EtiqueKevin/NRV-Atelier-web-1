<?php

namespace nrv\infrastructure\repositories;

use nrv\core\domain\entities\Panier\Panier;
use nrv\core\domain\entities\Panier\PanierItem;
use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

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
        }catch (\Exception $e){
            throw new RepositoryException('UtilisateurByEmail : erreur lors du chargemement utilisateur '.$e->getMessage());
        }
        return $utilisateurEntity;
    }


    public function getPanier($idUser) : Panier
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

    public function getPanierItems($idPanier) : array
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
                $panierItemEntity = new PanierItem($panierItem['id_panier'], $panierItem['id_soiree'], $panierItem['tarif'], $panierItem['tarif_total'], $panierItem['quantite']);
                $panierItemEntity->setID($panierItem['id']);
                $panierItemsRes[] = $panierItemEntity;
            }

        } catch (\Exception $e) {
            throw new RepositoryException('getPanierItems : erreur lors du chargemement panier '. $idPanier ." " . $e->getMessage());
        }
        return $panierItemsRes;
    }

    public function addPanier($idSoiree, $idPanier, $tarif, $qte) : void
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO paniers (id_soiree, id_panier, tarif, quantite) VALUES (?, ?, ?, ?)');
            $stmt->bindParam(1, $idSoiree);
            $stmt->bindParam(2, $idPanier);
            $stmt->bindParam(3, $tarif);
            $stmt->bindParam(4, $qte);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('addPanier : erreur lors de l\'ajout au panier '. $idUser ." " . $e->getMessage());
        }
    }

    public function updatePanier($panierItem) : void
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE paniers SET qte = ? WHERE id_panier = ? AND id_soiree = ?');
            $stmt->bindParam(1, $panierItem->qte);
            $stmt->bindParam(2, $panierItem->ID);
            $stmt->bindParam(3, $panierItem->idSoiree);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new RepositoryException('updatePanier : erreur lors de la mise à jour du panier '. $panierItem->idPanier ." " . $e->getMessage());
        }
    }
}