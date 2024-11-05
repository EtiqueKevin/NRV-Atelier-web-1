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

    /**
     * @param PanierServiceInterface $panierService
     */

    public function __construct(PanierServiceInterface $panierService)
    {
        $this->panierService = $panierService;
    }

    /**
     * AJOUTE UNE SOIREE AU PANIER DE L'UTILISATEUR EN INDIQUANT LES INFOS DE LA SOIREE DANS LE BODY
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
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

        if ((filter_var($idSoiree,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS)!== $idSoiree ||
            (int) filter_var($tarif,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $tarif ||
            filter_var($typeTarif,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $typeTarif ||
            (int) filter_var($qte,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $qte)) {
            throw new HttpBadRequestException($rq, 'data non valide : validator && sanitize');
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