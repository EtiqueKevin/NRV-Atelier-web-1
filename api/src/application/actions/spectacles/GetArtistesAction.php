<?php

namespace nrv\application\actions\spectacles;

use nrv\application\actions\AbstractAction;
use nrv\core\services\artiste\ArtisteServiceInterface;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetArtistesAction extends AbstractAction{

    private ArtisteServiceInterface $artisteService;

    /**
     * @param ArtisteServiceInterface $artisteService
     */
    public function __construct(ArtisteServiceInterface $artisteService){
        $this->artisteService = $artisteService;
    }


    /**
     * RECUPERE TOUS LES ARTISTES DISPONIBLES
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $artistes = $this->artisteService->getArtistes();
        $res = [
            'type' => 'collection',
            'artistes' => $artistes
        ];

        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}