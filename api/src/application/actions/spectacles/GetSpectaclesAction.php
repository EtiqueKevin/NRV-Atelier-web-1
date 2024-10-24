<?php

namespace nrv\application\actions\spectacles;

use nrv\application\actions\AbstractAction;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

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

        if (!empty($params)) {
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
                $spectacles = $this->spectacleService->getSpectacles($dates, $styles, $lieux);
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
            }catch (\Exception $e){
                throw new HttpBadRequestException($rq, $e->getMessage());
            }

        } else {
            try {
                $spectacles = $this->spectacleService->getAllSpectacles();
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
            }catch (\Exception $e){
                throw new HttpBadRequestException($rq, $e->getMessage());
            }
        }




        $rs->getBody()->write(json_encode($res));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}