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

    /**
     * @param SpectacleServiceInterface $spectacleService
     */

    public function __construct(SpectacleServiceInterface $spectacleService)
    {
        $this->spectacleService = $spectacleService;
    }


    /**
     *CREER UN SPECTACLE SELON LES INFORMATIONS PASSSEES DANS LE BODY DE LA REQUETE
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface{

        $data = $rq->getParsedBody();
        $data['artistes'] = json_decode($data['artistes'], true);

        $placeInputValidator = Validator::key('titre', Validator::stringType()->notEmpty())
            ->key('description', Validator::stringType()->notEmpty())
            ->key('heure', Validator::stringType()->notEmpty())
            ->key('url_video', Validator::stringType()->notEmpty())
            ->key('idSoiree', Validator::stringType()->notEmpty())
            ->key('artistes', Validator::arrayType()->notEmpty());
        try {
            $placeInputValidator->assert($data);
        } catch (NestedValidationException $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        if((filter_var($data['titre'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS)!== $data['titre'] ||
            filter_var($data['description'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $data['description'] ||
            filter_var($data['heure'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $data['heure'] ||
            filter_var($data['idSoiree'],
                FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $data['idSoiree'])){
            throw new HttpBadRequestException($rq, 'data non valide : validator && sanitize');
        }

        $directory = __DIR__ . '/../../../../public/img';

        $uploadedFiles = $rq->getUploadedFiles();

        $tabNomImage = [];

        if (!empty($uploadedFiles['images'])) {
            $uploadedFile = $uploadedFiles['images'];
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                var_dump($directory);
                $filename = $this->spectacleService->moveUploadedFile($directory, $uploadedFile);
                $tabNomImage[] = $filename;
            }
        }

        $titre = $data['titre'];
        $description = $data['description'];
        $heure = $data['heure'];
        $url_video = $data['url_video'];
        $idSoiree = $data['idSoiree'];
        $artistes = $data['artistes'];

        $spectacleCreerDTO = new SpectacleCreerDTO($titre,$description,$heure,$url_video,$idSoiree,$tabNomImage,$artistes);
        try {
            $this->spectacleService->putSpectacle($spectacleCreerDTO);
        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        return $rs->withStatus(201)->withHeader('Content-Type', 'application/json');
    }
}