<?php

namespace nrv\application\actions\soirees;

use nrv\application\actions\AbstractAction;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class GetSoireeByIdBackofficeAction extends AbstractAction{

    private SoireeServiceInterface $soireeService;

    public function __construct(SoireeServiceInterface $soireeService){
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idSoiree = $args['ID-SOIREE'];
        if ( !(Validator::uuid()->validate($idSoiree))) {
            throw new HttpBadRequestException($rq,'id soiree non valide : validator');
        }

        if (!(preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/', $idSoiree))) {
            throw new HttpBadRequestException($rq,'id soiree non valide : sanitaze');
        }
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
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}