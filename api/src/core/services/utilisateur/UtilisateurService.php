<?php

namespace nrv\core\services\utilisateur;


use nrv\core\domain\entities\utilisateur\Utilisateur;
use nrv\core\dto\utilisateur\UtilisateurDTO;
use nrv\core\dto\utilisateur\UtilisateurInputCreationDTO;
use nrv\core\dto\utilisateur\UtilisateurInputCreationSaveDTO;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\core\dto\utilisateur\UtilisateurOutputDTO;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use PHPUnit\Exception;

class UtilisateurService implements UtilisateurServiceInterface{

    private UtilisateursRepositoryInterface $utilisateursRepository;

    public function __construct($utilisateursRepository){
        $this->utilisateursRepository = $utilisateursRepository;
    }

    public function verifyCredentials(UtilisateurInputDTO $utiInpuDTO):UtilisateurDTO{
        try{
            $user = $this->utilisateursRepository->UtilisateurByEmail($utiInpuDTO->email);
            if ($user && password_verify($utiInpuDTO->mdp, $user->mdp)) {
                return $user->toDTO();
            }else{
                throw new UtilisateurException('mot de passe ou identifiant incorrect');
            }
        }catch (\Exception $e){
            throw new UtilisateurException('Connexion échoué : '.$e->getMessage());
        }
    }

    public function createUtilisateur(UtilisateurInputCreationDTO $utiInputCreDTO):void{
        try{
            $this->utilisateursRepository->UtilisateurByEmail($utiInputCreDTO->email);
        }catch (RepositoryEntityNotFoundException $e){

        }catch (Exception $e){
            throw new UtilisateurException('createutilisateur : recherche utilisateur',$e->getMessage());
        }

        if(!$utiInputCreDTO->mdp == $utiInputCreDTO->mdp2){
            throw new UtilisateurException("createutilisateur : mot de passe et mot de passe de confirmation differente");
        }

        $mdphash= password_hash($utiInputCreDTO->mdp, PASSWORD_DEFAULT);

        try {
            $utiEntity = new Utilisateur($utiInputCreDTO->nom,$utiInputCreDTO->prenom,$utiInputCreDTO->email,$mdphash,0);
            $id = $this->utilisateursRepository->saveUtilisateur($utiEntity);
        }catch (\Exception $e){
            throw new UtilisateurException('createutilisateur ; erreur insertion bd utilisateur : '.$e->getMessage());
        }
    }



}