<?php

namespace nrv\application\actions\soirees;

use nrv\application\actions\AbstractAction;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\dto\soiree\SoireeCreerDTO;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

class PutSoireeAction extends AbstractAction
{

    private SoireeServiceInterface $soireeService;

    public function __construct(SoireeServiceInterface $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $data = $rq->getParsedBody();
        $nom = $data['nom'];
        $thematique = $data['thematique'];
        $dateData = $data['date'];
        $lieuData = $data['lieu'];
        $tarif_normal = $data['tarif_normal'];
        $tarif_reduit = $data['tarif_reduit'];

        $soireeCreerDTO = new SoireeCreerDTO($nom, $thematique, $dateData, $lieuData, $tarif_normal, $tarif_reduit);
        try {
            $this->soireeService->putSoiree($soireeCreerDTO);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        return $rs->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
}