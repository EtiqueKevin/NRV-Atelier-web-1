<?php

namespace nrv\application\actions;

use nrv\core\services\soiree\SoireeException;
use nrv\core\services\soiree\SoireeService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeByIdAction extends AbstractAction
{

    private SoireeService $soireeService;

    public function __construct(SoireeService $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idSoiree = $args['ID-SOIREE'];
        try {
            $soiree = $this->soireeService->getSoireeById($idSoiree);
            $res = [
                'type' => 'ressource',
                'soiree' => $soiree
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