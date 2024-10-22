<?php

namespace nrv\core\services\utilisateur;


use nrv\core\dto\utilisateur\UtilisateurDTO;
use nrv\core\dto\utilisateur\UtilisateurInputDTO;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;

class UtilisateurService implements UtilisateurServiceInterface{

    private UtilisateursRepositoryInterface $utilisateursRepository;

    public function __construct($utilisateursRepository){
        $this->utilisateursRepository = $utilisateursRepository;
    }

    public function verifyCredentials(UtilisateurInputDTO $utiInpuDTO):UtilisateurDTO{
        try{
            $user = $this->authRepository->findByEmail($utiInpuDTO->email);
            if ($user && password_verify($utiInpuDTO->mdp, $user->mdp)) {
                return $user->toDTO();
            }else{
                throw new UtilisateurException('mot de passe ou identifiant incorrect');
            }
        }catch (\Exception $e){
            throw new UtilisateurException('Connexion échoué : '.$e->getMessage());
        }
    }



}