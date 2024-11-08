<?php

namespace nrv\application\actions\panier;

use nrv\application\actions\AbstractAction;
use nrv\core\dto\Panier\PanierModifierDTO;
use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class ModifierPanierAction extends AbstractAction
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
     * MODIFIER LE PANIER DE L'UTILISATEUR EN INDIQUANT LES INFOS DE LA SOIREE DANS LE BODY
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $data = $rq->getParsedBody();
        $idUser = $rq->getAttribute("UtiOutDTO")->id;
        $idSoiree = $data['idSoiree'];
        $typeTarif = $data['typeTarif'];
        $qte = $data['qte'];

        try {
            Validator::stringType()->notEmpty()->assert($idSoiree);
            Validator::stringType()->notEmpty()->assert($typeTarif);
            Validator::intType()->min(0)->assert($qte);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        if ((filter_var($idSoiree,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS)!== $idSoiree ||
            filter_var($typeTarif,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $typeTarif ||
            (int) filter_var($qte,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $qte)) {
            throw new HttpBadRequestException($rq, 'data non valide : validator && sanitize');
        }

        $panierModifierDTO = new PanierModifierDTO($idUser, $idSoiree, $typeTarif, $qte);
        try {
            $panier = $this->panierService->modifierPanier($panierModifierDTO);
        }catch (\Exception $e){
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