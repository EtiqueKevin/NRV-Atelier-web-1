<?php

namespace nrv\application\actions\soirees;

use nrv\application\actions\AbstractAction;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireesAction extends AbstractAction
{

    private SoireeServiceInterface $soireeService;

    public function __construct(SoireeServiceInterface $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $soirees = $this->soireeService->getSoirees();
        $res = [
            'type' => 'collection',
            'soirees' => $soirees
        ];

        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}