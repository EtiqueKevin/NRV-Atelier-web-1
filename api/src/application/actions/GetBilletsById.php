<?php

namespace nrv\application\actions;

use nrv\core\dto\billet\BilletInputDTO;
use nrv\core\services\billet\BilletServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use nrv\core\services\utilisateur\UtilisateurServiceInterface;

class GetBilletsById extends AbstractAction {

    private  BilletServiceInterface $billetService;

    private UtilisateurServiceInterface $utilisateurService;

    public function __construct(BilletServiceInterface $billetService, UtilisateurServiceInterface $utilisateurService){
        $this->billetService = $billetService;
        $this->utilisateurService = $utilisateurService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{
        try {
            $idUti = $rq->getAttribute('UtiOutDTO')->id;
            $idBillet = $args['ID-BILLET'];
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
        return $rs->withHeader('Content-Type', 'application/json');
    }


}