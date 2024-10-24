<?php

namespace nrv\application\actions\billets;

use nrv\application\actions\AbstractAction;
use nrv\core\services\billet\BilletServiceInterface;
use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class PostPayerCommandeAction extends AbstractAction
{

    private PanierServiceInterface $panierService;
    private BilletServiceInterface $billetService;

    public function __construct(PanierServiceInterface $panierService, BilletServiceInterface $billetService)
    {
        $this->panierService = $panierService;
        $this->billetService = $billetService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idUser = $rq->getAttribute('UtiOutDTO')->id;
        $numero = $rq->getParsedBody()['numero'];
        $date = $rq->getParsedBody()['date'];
        $code = $rq->getParsedBody()['code'];

        try {
            $panierDTO = $this->panierService->getPanier($idUser);
            $valide = $this->panierService->verifier($numero, $date, $code, $panierDTO);

            if ($valide) {
                $billetDTO = $this->billetService->payerCommande($panierDTO);
            }

            $res = [
                'type' => 'ressource',
                'billet' => $billetDTO,
            ];
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}