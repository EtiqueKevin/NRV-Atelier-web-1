<?php

namespace nrv\application\actions;

use nrv\core\services\spectacle\SpectacleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSpectaclesAction extends AbstractAction
{
    private SpectacleService $spectacleService;

    public function __construct(SpectacleService $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        try {
            $spectacles = $this->spectacleService->getAllSpectacles();
            $res = [
                'type' => 'ressource',
                'spectacles' => $spectacles
            ];
        }catch (\Exception $e){
            $res = [
                'type' => 'erreur',
                'message' => $e->getMessage()
            ];
        }


        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}