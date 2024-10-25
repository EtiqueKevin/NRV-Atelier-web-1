<?php

namespace nrv\application\actions\soirees;

use nrv\application\actions\AbstractAction;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetStylesAction extends AbstractAction
{
    private SoireeServiceInterface $soireeService;

    /**
     * @param SoireeServiceInterface $soireeService
     */
    public function __construct(SoireeServiceInterface $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    /**
     * RECUPERE TOUS LES STYLES DE SOIREES DISPONIBLES
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $styles = $this->soireeService->getStyles();

        $res = [
            "type" => "collection",
            "styles"=> $styles
        ];

        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}