<?php

namespace nrv\application\actions\panier;

use nrv\application\actions\AbstractAction;
use nrv\core\dto\Panier\PanierAddDTO;
use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
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
        $typeTarif = $params['typeTarif'];
        $qte = $params['qte'];
        $idUser = $rq->getAttribute('UtiOutDTO')->id;

        try {
            Validator::stringType()->notEmpty()->assert($idSoiree);
            Validator::intType()->notEmpty()->assert($tarif);
            Validator::stringType()->notEmpty()->assert($typeTarif);
            Validator::intType()->notEmpty()->assert($qte);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }


        try {
            $panierAddDTO = new PanierAddDTO($idUser, $idSoiree, $tarif,$typeTarif, $qte);
            $panier = $this->panierService->addPanier($panierAddDTO);
        }catch(\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        $res = [
            'type' => 'resource',
            'panier' => $panier
        ];
        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}