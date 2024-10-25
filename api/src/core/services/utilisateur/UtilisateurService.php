<?php

namespace nrv\core\services\utilisateur;


use Monolog\Level;
use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\utilisateur\UtilisateurDTO;
use nrv\core\dto\utilisateur\UtilisateurInputCreationDTO;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use PHPUnit\Exception;
use Psr\Log\LoggerInterface;

class UtilisateurService implements UtilisateurServiceInterface{

    private UtilisateursRepositoryInterface $utilisateursRepository;

    private LoggerInterface $logger;

    /**
     * @param UtilisateursRepositoryInterface $utilisateursRepository
     */
    public function __construct(UtilisateursRepositoryInterface $utilisateursRepository, LoggerInterface $logger){
        $this->utilisateursRepository = $utilisateursRepository;
        $this->logger = $logger;
    }

    /**
     * VERIFIE LES CREDENTIELS D'UN UTILISATEUR
     * @param UtilisateurInputDTO $utiInpuDTO
     * @return UtilisateurDTO
     * @throws UtilisateurException
     */
    public function verifyCredentials(UtilisateurInputDTO $utiInpuDTO):UtilisateurDTO{
        try{
            $user = $this->utilisateursRepository->UtilisateurByEmail($utiInpuDTO->email);

            if ($user && password_verify($utiInpuDTO->mdp, $user->mdp)) {
                $this->logger->log(Level::Info, "UtilisateurService - verifyCrendentials : " . date('Y-m-d H:i:s'));
                return $user->toDTO();
            }else{
                $this->logger->log(Level::Error, "UtilisateurService - verifyCredentials : " . "mot de passe ou identifiant incorrect | " . date('Y-m-d H:i:s'));
                throw new UtilisateurException('mot de passe ou identifiant incorrect');
            }
        }catch (\Exception $e){
            $this->logger->log(Level::Error, "UtilisateurService - verifyCredentials : " . "Connexion échoué | " . date('Y-m-d H:i:s'));
            throw new UtilisateurException('Connexion échoué : '.$e->getMessage());
        }
    }


    /**
     * CREE UN UTILISATEUR
     * @param UtilisateurInputCreationDTO $utiInputCreDTO
     * @return void
     * @throws UtilisateurException
     */
    public function createUtilisateur(UtilisateurInputCreationDTO $utiInputCreDTO):void{
        try{
            $this->utilisateursRepository->UtilisateurByEmail($utiInputCreDTO->email);
        }catch (RepositoryEntityNotFoundException $e){

        }catch (Exception $e){
            $this->logger->log(Level::Error, "UtilisateurService - createUtilisateur : " . "recherche utilisateur echoué | " . date('Y-m-d H:i:s'));
            throw new UtilisateurException('createutilisateur : recherche utilisateur',$e->getMessage());
        }

        if(!$utiInputCreDTO->mdp == $utiInputCreDTO->mdp2){
            $this->logger->log(Level::Error, "UtilisateurService - createUtilisateur : " . "mot de passe et mot de passe de confirmation différents | " . date('Y-m-d H:i:s'));
            throw new UtilisateurException("createutilisateur : mot de passe et mot de passe de confirmation differente");
        }

        $mdphash= password_hash($utiInputCreDTO->mdp, PASSWORD_DEFAULT);

        try {
            $utiEntity = new Utilisateur($utiInputCreDTO->nom,$utiInputCreDTO->prenom,$utiInputCreDTO->email,$mdphash,0);
            $id = $this->utilisateursRepository->saveUtilisateur($utiEntity);
            $this->logger->log(Level::Info, "UtilisateurService - createUtilisateur : "  . date('Y-m-d H:i:s'));

        }catch (\Exception $e){
            $this->logger->log(Level::Error, "UtilisateurService - verifyCredentials : " . "mot de passe ou identifiant incorrect" . date('Y-m-d H:i:s'));
            throw new UtilisateurException('createutilisateur ; erreur insertion bd utilisateur : '.$e->getMessage());
        }
    }


    /**
     * RECUPERE UN UTILISATEUR PAR RAPPORT A SON ID
     * @param string $id
     * @return UtilisateurDTO
     */
    public function getUtilisateurById(string $id):UtilisateurDTO{
        $utiEntity = $this->utilisateursRepository->UtilisateurById($id);
        $this->logger->log(Level::Info, "UtilisateurService - getUtilisateurById : " . date('Y-m-d H:i:s'));
        return new UtilisateurDTO($utiEntity);
    }


}