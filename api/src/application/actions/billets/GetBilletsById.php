<?php

namespace nrv\application\actions\billets;

use nrv\application\actions\AbstractAction;
use nrv\core\dto\billet\BilletInputDTO;
use nrv\core\services\billet\BilletServiceInterface;
use nrv\core\services\utilisateur\UtilisateurServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

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
        return $rs->withStatus(200)->withHeader('Content-Type', 'text/html');
    }


}