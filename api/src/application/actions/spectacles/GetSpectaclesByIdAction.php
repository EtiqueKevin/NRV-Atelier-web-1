<?php

namespace nrv\application\actions\spectacles;

use nrv\application\actions\AbstractAction;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class GetSpectaclesByIdAction extends AbstractAction
{
    private SpectacleServiceInterface $spectacleService;

    public function __construct(SpectacleServiceInterface $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['ID-SPECTACLE'];
        try {
            $spectacleDTO = $this->spectacleService->getSpectacleById($id);
            $artistesIds = $this->spectacleService->getArtistesBySpectacle($id);

            $artistesLinks = array_map(function($artisteId) {
                return [
                    'href' => "artiste/{$artisteId}"
                ];
            }, $artistesIds);

            $res = [
                'type' => 'ressource',
                'spectacle' => $spectacleDTO,
                'links' => [
                    'artistes' => $artistesLinks
                ]
            ];
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }


        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}