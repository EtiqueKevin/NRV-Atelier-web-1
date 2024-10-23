<?php

namespace nrv\application\actions;

use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddPanierAction extends AbstractAction
{

    private PanierServiceInterface $panierService;

    public function __construct(PanierServiceInterface $panierService)
    {
        $this->panierService = $panierService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $params = $rq->getParsedBody();
        $idSoiree = $params['idSoiree'];
        $tarif = $params['tarif'];
        $qte = $params['qte'];
        $idUser = $rq->getAttribute('UtiOutDTO')->id;


        $panier = $this->panierService->addPanier($idUser, $idSoiree, $tarif, $qte);
        $res = [
            'type' => 'resource',
            'panier' => $panier
        ];

        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}