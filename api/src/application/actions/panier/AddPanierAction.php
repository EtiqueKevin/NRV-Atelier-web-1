<?php

namespace nrv\application\actions\panier;

use nrv\application\actions\AbstractAction;
use nrv\core\services\panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

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


        try {
            $panier = $this->panierService->addPanier($idUser, $idSoiree, $tarif, $qte);
        }catch(\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        $res = [
            'type' => 'resource',
            'panier' => $panier
        ];
        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}