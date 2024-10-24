<?php

namespace nrv\application\actions\soirees;

use nrv\application\actions\AbstractAction;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class GetSoireeByIdBackofficeAction extends AbstractAction{

    private SoireeServiceInterface $soireeService;

    public function __construct(SoireeServiceInterface $soireeService){
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idSoiree = $args['ID-SOIREE'];
        try {
            $gestionPlaceSoiree = $this->soireeService->gestionPlaceBackOffice($idSoiree);
            $res = [
                'type' => 'ressource',
                'placeSoiree' => $gestionPlaceSoiree,
            ];
        } catch (\Exception $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}