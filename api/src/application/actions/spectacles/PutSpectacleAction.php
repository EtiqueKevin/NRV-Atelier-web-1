<?php

namespace nrv\application\actions\spectacles;

use nrv\application\actions\AbstractAction;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\dto\soiree\SoireeCreerDTO;
use nrv\core\dto\spectacle\SpectacleCreerDTO;
use nrv\core\services\soiree\SoireeServiceInterface;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class PutSpectacleAction extends AbstractAction{

    private SpectacleServiceInterface $spectacleService;

    public function __construct(SpectacleServiceInterface $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{

        try{
            $data = $rq->getParsedBody();
            $titre = $data['titre'];
            $description = $data['description'];
            $heure = $data['heure'];
            $url_video = $data['url_video'];
            $idSoiree = $data['idSoiree'];
            $imgs = $data['imgs'];
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq,'parametre manquant ou incorrect'. $e->getMessage());
        }


        $spectacleCreerDTO = new SpectacleCreerDTO($titre,$description,$heure,$url_video,$idSoiree,$imgs);
        try {
            $this->spectacleService->putSpectacle($spectacleCreerDTO);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        return $rs->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
}