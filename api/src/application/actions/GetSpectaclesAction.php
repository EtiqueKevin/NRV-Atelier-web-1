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
        $spectacles = $this->spectacleService->getAllSpectacles();
        $res = [
            'type' => 'ressource',
            'spectacles' => $spectacles
        ];

        $rs->getBody()->write(json_encode($spectacles));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}