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
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class PostSpectacleAction extends AbstractAction{

    private SpectacleServiceInterface $spectacleService;

    public function __construct(SpectacleServiceInterface $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{

        $data = $rq->getParsedBody();

        $placeInputValidator = Validator::key('titre', Validator::stringType()->notEmpty())
            ->key('description', Validator::stringType()->notEmpty())
            ->key('heure', Validator::stringType()->notEmpty())
            ->key('url_video', Validator::intType()->notEmpty())
            ->key('idSoiree', Validator::intType()->notEmpty())
            ->key('imgs',Validator::arrayType()->notEmpty());
        try {
            $placeInputValidator->assert($data);
        } catch (NestedValidationException $e) {
            throw new HttpBadRequestException($rq, $e->getMessages());
        }

        $titre = $data['titre'];
        $description = $data['description'];
        $heure = $data['heure'];
        $url_video = $data['url_video'];
        $idSoiree = $data['idSoiree'];
        $imgs = $data['imgs'];

        $spectacleCreerDTO = new SpectacleCreerDTO($titre,$description,$heure,$url_video,$idSoiree,$imgs);
        try {
            $this->spectacleService->putSpectacle($spectacleCreerDTO);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        return $rs->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
}