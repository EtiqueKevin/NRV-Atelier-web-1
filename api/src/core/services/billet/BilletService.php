<?php

namespace nrv\core\services\billet;

use Monolog\Level;
use nrv\core\dto\billet\BilletDTO;
use nrv\core\dto\billet\BilletInputDTO;
use nrv\core\dto\billet\BilletOutputDTO;
use nrv\core\dto\Panier\PanierDTO;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use Psr\Log\LoggerInterface;

class BilletService implements BilletServiceInterface{

    private UtilisateursRepositoryInterface $utilisateursRepository;
    private SoireesRepositoryInterface $soireesRepository;

    private LoggerInterface $logger;

    /**
     * @param UtilisateursRepositoryInterface $utilisateursRepository
     * @param SoireesRepositoryInterface $soireesRepository
     */
    public function __construct(UtilisateursRepositoryInterface $utilisateursRepository, SoireesRepositoryInterface$soireesRepository, LoggerInterface $logger){
        $this->utilisateursRepository = $utilisateursRepository;
        $this->soireesRepository = $soireesRepository;
        $this->logger = $logger;
    }


    /**
     * RECUPERE LES BILLETS D'UN UTILISATEUR
     * @param string $id
     * @return BilletOutputDTO
     */
    public function getBilletsByIdUtilisateur(string $id): BilletOutputDTO{
        try {
            $billetsTab = $this->utilisateursRepository->getBilletsByIdUtilisateur($id);
            $billetsTabRes = [];
            foreach ($billetsTab as $b){
                $ids = $b->id_soiree;
                $soiree = $this->soireesRepository->getSoireeById($ids);
                $b->setNomSoiree($soiree->nom);
                $billetsTabRes[] = $b;
            }
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "BilletService - getBilletsByIdUtilisateur : id uti : ".$id." ");
            throw new BilletException('BilletService : getBilletsByIdUtilisateur : '.$e->getMessage());
        }

        $this->logger->log(Level::Info, "BilletService - getBilletsByIdUtilisateur : id uti : ".$id." ");
        return new BilletOutputDTO($billetsTabRes);
    }


    /**
     * RECUPERE UN BILLET PAR RAPPORT A SON ID
     * @param BilletInputDTO $biInputDTO
     * @return BilletDTO
     * @throws BilletException
     */
    public function getBilletById(BilletInputDTO $biInputDTO): BilletDTO{
        try {
            $billetEntity = $this->utilisateursRepository->getBilletById($biInputDTO->idBillet);
            $ids = $billetEntity->id_soiree;
            $soiree = $this->soireesRepository->getSoireeById($ids);
            $billetEntity->setNomSoiree($soiree->nom);
            if(!($biInputDTO->id_utilisateur === $billetEntity->id_utilisateur)){
                throw new BilletException('access refused');

            }
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "BilletService - payerCommande : id billet : ".$biInputDTO->idBillet." erreur : ".$e->getMessage());
            throw new BilletException(' BilletService : getBilletById '.$e->getMessage());
        }

        $this->logger->log(Level::Info, "BilletService - getBilletById : id billet : ".$biInputDTO->idBillet." ");
        return $billetEntity->toDTO();
    }

    /**
     * PAYE UNE COMMANDE D'UN UTILISATEUR EN CREANT LES BILLETS, LES ASSIGNANT A L'UTILISATEUR ET VIDANT LE PANIER
     * @param string $idUser
     * @return void
     */
    public function payerCommande(string $idUser) :void {
        try {
            $panier = $this->utilisateursRepository->getPanier($idUser); //je récupère le panier de l'utilisateur
            $panierItemsRes = $this->utilisateursRepository->getPanierItems($panier->idPanier); //je récupère les items du panier de l'utilisateur
            $items = "";
            foreach ($panierItemsRes as $panierItem) { //pour tous les items du panier

                //on récupère l'heure de début de la soirée parce que relou la bd
                $spectacles = $this->soireesRepository->getSpectacleByIdSoiree($panierItem->idSoiree); //on récupère les spectacles de la soirée
                $heureDebut = $this->soireesRepository->getSpectacleById($spectacles[0])->heure; //on initialise l'heure de début à la première heure de spectacle du tableau
                foreach ($spectacles as $spectacle) { // pour tous les spectacles
                    if ($spectacle < $heureDebut) { //si le spectacle est plus tôt que l'heure de début deja definie
                        $heureDebut = $this->soireesRepository->getSpectacleById($spectacle)->heure;; //on le met en tant qu'heure de début
                    }
                }
                for ($i = 0; $i < $panierItem->qte; $i++) { //pour chaque billet
                    $items .= "('$idUser','{$panierItem->idSoiree}','{$heureDebut->format('Y-m-d H:i:s')}','{$panierItem->typeTarif}'),\n"; // je crée un tableau pour requêtes multiples
                }
            }
            $items = substr($items, 0, -2); //je retire la dernière virgule
            $this->utilisateursRepository->addBillets($items); //j'ajoute les billets
            $this->utilisateursRepository->viderPanier($panier->idPanier);
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "BilletService - payerCommande : id uti : ". $idUser." erreur ".$e->getMessage());
            throw new BilletException(" BilletService : payerCommande : ".$e->getMessage());
        }

        $this->logger->log(Level::Info, "BilletService - payerCommande : id uti : ". $idUser." ");
    }
}