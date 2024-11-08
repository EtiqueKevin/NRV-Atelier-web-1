<?php

namespace nrv\application\actions\billets;

use nrv\core\services\billet\BilletServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class GetBilletsByIdUtilisateur{

    private  BilletServiceInterface $billetService;

    /**
     * @param BilletServiceInterface $billetService
     */
    public function __construct(BilletServiceInterface $billetService){
        $this->billetService = $billetService;
    }

    /**
     * RENVOIE TOUS LES BILLETS D'UN UTILISATEUR
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idUti = $rq->getAttribute('UtiOutDTO')->id;
        try {
            $billetOutDTO = $this->billetService->getBilletsByIdUtilisateur($idUti);

            $res = [
                'type' => 'collection',
                'billets' => $billetOutDTO,
            ];
        } catch (\Exception $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }


}