<?php

namespace nrv\application\actions\spectacles;

use nrv\application\actions\AbstractAction;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;
use nrv\core\dto\spectacle\InputFiltresSpectaclesDTO;

class GetSpectaclesAction extends AbstractAction
{
    private SpectacleServiceInterface $spectacleService;

    public function __construct(SpectacleServiceInterface $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $params = $rq->getQueryParams();
        $page = (int)($params['page'] ?? 1);  // Toujours s'assurer que la page est un entier

        $dates = [];
        $styles = [];
        $lieux = [];

        if (isset($params['dates'])) {
            $dates = explode(";" ,$params['dates']);
            foreach ($dates as $d) {
                $dateValidator = Validator::date('Y-m-d')->notEmpty();
                try {
                    $dateValidator->assert($d);
                } catch (\Exception $e) {
                    throw new \HttpInvalidParamException($rq, $e->getMessage());
                }
            }
        }
        if (isset($params['styles'])) {
            $styles = explode(";" ,$params['styles']);
        }
        if (isset($params['lieux'])) {
            $lieux = explode(";", $params['lieux']);
        }

        try {
            $nbSpectacles = $this->spectacleService->getNbSpectacles(new InputFiltresSpectaclesDTO($dates, $styles, $lieux, $page));

            // On récupère les spectacles avec pagination
            $spectacles = $this->spectacleService->getSpectacles(new InputFiltresSpectaclesDTO($dates, $styles, $lieux, $page));

            $spectaclesWithHref = array_map(function($spectacle) {
                return [
                    'spectacle' => $spectacle,
                    'links' =>[
                        'self' =>[
                            'href' => '/spectacle/' . $spectacle->getId()
                        ]
                    ]
                ];
            }, $spectacles);
            $res = [
                'type' => 'collection',
                'spectacles' => $spectaclesWithHref,
            ];

        } catch (\Exception $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        //numéro de page
        $res['page'] = $page;


        // Ajouter des liens vers la page suivante et la page précédente
        if ($page > 1) {
            $res['links']['previous'] = [
                'href' => '/spectacles?page=' . ($page - 1)
            ];
        }

        $dernierePage = ceil($nbSpectacles / 12);
        if ($page < $dernierePage) {
            $res['links']['next'] = [
                'href' => '/spectacles?page=' . ($page + 1)
            ];
        }


        $rs->getBody()->write(json_encode($res));
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}
