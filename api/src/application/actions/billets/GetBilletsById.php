<?php

namespace nrv\application\actions\billets;

use nrv\application\actions\AbstractAction;
use nrv\core\dto\billet\BilletInputDTO;
use nrv\core\services\billet\BilletServiceInterface;
use nrv\core\services\utilisateur\UtilisateurServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class GetBilletsById extends AbstractAction {

    private  BilletServiceInterface $billetService;

    private UtilisateurServiceInterface $utilisateurService;

    /**
     * @param BilletServiceInterface $billetService
     * @param UtilisateurServiceInterface $utilisateurService
     */
    public function __construct(BilletServiceInterface $billetService, UtilisateurServiceInterface $utilisateurService){
        $this->billetService = $billetService;
        $this->utilisateurService = $utilisateurService;
    }
    /**
     * RECUPERE UN BILLET PAR SON ID ET REND UN JSON AVEC LES INFOS DU BILLET ET DE L'ACHETEUR
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     * @throws HttpBadRequestException
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{

        $idUti = $rq->getAttribute('UtiOutDTO')->id;
        $idBillet = $args['ID-BILLET'];

        if ( !(Validator::uuid()->validate($idBillet))) {
            throw new HttpBadRequestException($rq,'id billet non valide : validator');
        }

        if (!(preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/', $idBillet))) {
            throw new HttpBadRequestException($rq,'id billet non valide : sanitaze');
        }

        try {
            $billeInputDTO = new BilletInputDTO($idBillet,$idUti);
            $billetDTO = $this->billetService->getBilletById($billeInputDTO);

            $UtiDTO = $this->utilisateurService->getUtilisateurById($idUti);

            $res = [
                'type' => 'collection',
                'billet' => $billetDTO,
                'acheteur' =>[
                    'nom' => $UtiDTO->nom,
                    'prenom' => $UtiDTO->prenom
                ]
            ];
        } catch (\Exception $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'text/html');
    }


}