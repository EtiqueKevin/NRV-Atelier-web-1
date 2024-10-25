<?php

namespace nrv\application\actions\soirees;

use nrv\application\actions\AbstractAction;
use nrv\core\domain\entities\lieu\Lieu;
use nrv\core\dto\soiree\SoireeCreerDTO;
use nrv\core\services\soiree\SoireeServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class PostSoireeAction extends AbstractAction
{

    private SoireeServiceInterface $soireeService;

    public function __construct(SoireeServiceInterface $soireeService)
    {
        $this->soireeService = $soireeService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $data = $rq->getParsedBody();

        $placeInputValidator = Validator::key('nom', Validator::stringType()->notEmpty())
            ->key('thematique', Validator::stringType()->notEmpty())
            ->key('lieu', Validator::stringType()->notEmpty())
            ->key('tarif_normal', Validator::intType()->notEmpty())
                ->key('tarif_reduit', Validator::intType()->notEmpty());
        try {
            $placeInputValidator->assert($data);
        } catch (NestedValidationException $e) {
            throw new HttpBadRequestException($rq, $e->getMessages());
        }
        if ((filter_var($data['nom'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS)!== $data['nom'] ||
            filter_var($data['thematique'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $data['thematique'] ||
            filter_var($data['lieu'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $data['lieu'] ||
            filter_var($data['date'],
                    FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $data['date'] ||
            filter_var($data['tarif_normal'],
                FILTER_SANITIZE_NUMBER_INT) !== $data['tarif_normal'] ||
            filter_var($data['tarif_reduit'],
                FILTER_SANITIZE_NUMBER_INT) !== $data['tarif_reduit'])) {
            throw new HttpBadRequestException($rq, 'data non valide : validator && sanitize');
        }

        $soireeCreerDTO = new SoireeCreerDTO($data['nom'], $data['thematique'], $data['date'], $data['lieu'], $data['tarif_normal'], $data['tarif_reduit']);
        try {
            $this->soireeService->postSoiree($soireeCreerDTO);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        return $rs->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
}