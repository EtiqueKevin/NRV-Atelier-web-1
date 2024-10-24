<?php

namespace nrv\application\actions\panier;

use nrv\application\actions\AbstractAction;
use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPanierAction extends AbstractAction
{

    private PanierServiceInterface $panierService;

    public function __construct(PanierServiceInterface $panierService)
    {
        $this->panierService = $panierService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idUser = $rq->getAttribute("UtiOutDTO")->id;
        $panier = $this->panierService->getPanier($idUser);

        $res = [
            'type' => 'resource',
            'panier' => $panier
        ];

        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');

    }
}