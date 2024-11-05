<?php

namespace nrv\application\actions\utilisateur;

use nrv\application\actions\AbstractAction;
use nrv\core\dto\utilisateur\UtilisateurInputCreationDTO;
use nrv\core\services\utilisateur\UtilisateurServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class SignUpAction extends AbstractAction
{
    private UtilisateurServiceInterface $utilisateurService;


    /**
     * @param UtilisateurServiceInterface $utilisateurService
     */
    public function __construct(UtilisateurServiceInterface $utilisateurService) {
        $this->utilisateurService = $utilisateurService;
    }


    /**
     * CREE UN UTILISATEUR A PARTIR DES PARAMETRES PASSE DANS LE BODY DE LA REQUETE
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{

        $params = $rq->getParsedBody() ?? null;

        if (!isset($params['nom']) || !isset($params['prenom']) || !isset($params['email']) || !isset($params['mdp']) || !isset($params['mdp2'])) {
            throw new HttpBadRequestException($rq, 'Paramètres manquants');
        }

        $nom = filter_var($params['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $prenom = filter_var($params['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $email = filter_var($params['email'], FILTER_SANITIZE_EMAIL);

        $utiDTO = new UtilisateurInputCreationDTO($nom, $prenom, $email, $params['mdp'], $params['mdp2']);
        $this->utilisateurService->createUtilisateur($utiDTO);

        return $rs->withStatus(200);
    }
}