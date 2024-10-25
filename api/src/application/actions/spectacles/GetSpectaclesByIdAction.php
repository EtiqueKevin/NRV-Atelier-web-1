<?php

namespace nrv\application\actions\spectacles;

use nrv\application\actions\AbstractAction;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class GetSpectaclesByIdAction extends AbstractAction
{
    private SpectacleServiceInterface $spectacleService;


    /**
     * @param SpectacleServiceInterface $spectacleService
     */
    public function __construct(SpectacleServiceInterface $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }

    /**
     * RECUPERE UN SPECTACLE PAR SON ID PASSER DANS LA ROUTE
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['ID-SPECTACLE'];
        if ( !(Validator::uuid()->validate($id))) {
            throw new HttpBadRequestException($rq,'id spectacle non valide : validator');
        }

        if (!(preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/', $id))) {
            throw new HttpBadRequestException($rq,'id spectacle non valide : sanitaze');
        }
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