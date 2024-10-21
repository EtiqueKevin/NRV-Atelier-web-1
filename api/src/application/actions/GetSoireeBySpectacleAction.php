<?php

namespace nrv\application\actions;

use nrv\core\services\soiree\SoireeException;
use nrv\core\services\soiree\SoireeService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeBySpectacleAction extends AbstractAction
{

    private SoireeService $soireeService;

    public function __construct(SoireeService $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idSpectacle = $args['ID-SPECTACLE'];
        try {
            $soirees = $this->soireeService->getSoireeBySpectacle($idSpectacle);
            $res = [
                'type' => 'ressource',
                'soirees' => $soirees
            ];
        } catch (\Exception $e) {
            $res = [
                'type' => 'erreur',
                'message' => $e->getMessage()
            ];
        }


        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}