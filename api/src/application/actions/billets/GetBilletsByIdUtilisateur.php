<?php

namespace nrv\application\actions\billets;

use nrv\core\services\billet\BilletServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class GetBilletsByIdUtilisateur{

    private  BilletServiceInterface $billetService;
    public function __construct(BilletServiceInterface $billetService){
        $this->billetService = $billetService;
    }

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
        return $rs->withHeader('Content-Type', 'application/json');
    }


}