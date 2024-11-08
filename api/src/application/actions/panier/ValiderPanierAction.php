<?php

namespace nrv\application\actions\panier;

use nrv\application\actions\AbstractAction;
use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class ValiderPanierAction extends AbstractAction
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
     * VALIDE LE PANIER DE L'UTILISATEUR UNIQUEMENT GRACE AU A L'ID DU USER DANS LE TOKEN JWT
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idUser = $rq->getAttribute('UtiOutDTO')->id;
        try {
            $panier = $this->panierService->validerPanier($idUser);
        } catch (\Exception $e) {
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