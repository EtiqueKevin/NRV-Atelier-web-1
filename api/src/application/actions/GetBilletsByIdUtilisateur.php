<?php

namespace nrv\application\actions;

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
        $idUti = $args['ID-UTILISATEUR'];
        try {
            $billetOutDTO = $this->billetService->getBilletsByIdUtilisateur($idUti);

            $res = [
                'type' => 'collection',
                $billetOutDTO
            ];
        } catch (\Exception $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }


}