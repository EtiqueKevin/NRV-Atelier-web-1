<?php

namespace nrv\application\actions;

use nrv\core\services\soiree\SoireeException;
use nrv\core\services\soiree\SoireeService;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class GetSoireeByIdAction extends AbstractAction
{

    private SoireeServiceInterface $soireeService;

    public function __construct(SoireeServiceInterface $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idSoiree = $args['ID-SOIREE'];
        try {
            $soiree = $this->soireeService->getSoireeDetail($idSoiree);
            $spectaclesIds = $this->soireeService->getSpectacleByIdSoiree($idSoiree);

            $spectaclesLinks = array_map(function($spectacleId) {
                return [
                    'href' => "spectacle/{$spectacleId}"
                ];
            }, $spectaclesIds);

            $res = [
                'type' => 'ressource',
                'soiree' => $soiree,
                'links' => [
                    'spectacles' => $spectaclesLinks
            ]
            ];
        } catch (\Exception $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }


        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}