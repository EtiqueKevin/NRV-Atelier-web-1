<?php

namespace nrv\application\actions\billets;

use nrv\application\actions\AbstractAction;
use nrv\core\dto\Panier\PanierVerifDTO;
use nrv\core\services\billet\BilletServiceInterface;
use nrv\core\services\Panier\PanierException;
use nrv\core\services\Panier\PanierServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;

class PostPayerCommandeAction extends AbstractAction
{

    private PanierServiceInterface $panierService;
    private BilletServiceInterface $billetService;

    public function __construct(PanierServiceInterface $panierService, BilletServiceInterface $billetService)
    {
        $this->panierService = $panierService;
        $this->billetService = $billetService;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idUser = $rq->getAttribute('UtiOutDTO')->id;
        $numero = $rq->getParsedBody()['numero'];
        $dateExpiration = $rq->getParsedBody()['date'];
        $code = $rq->getParsedBody()['code'];

        $numeroValidator = Validator::digit()->length(16, 16);
        $codeValidator = Validator::digit()->length(3, 3);
        $dateExpirationValidator = Validator::date('m/y')->min('now');

        try {
            $panierDTO = $this->panierService->getPanier($idUser);
            $date = \DateTime::createFromFormat('m/y', $dateExpiration);

            if (!$numeroValidator->validate($numero)) {
                throw new PanierException('Numero invalide');
            }

            if(!$dateExpirationValidator->validate($dateExpiration) ){
                throw new PanierException('Date d\'expiration invalide');
            }

            if(!$codeValidator->validate($code)){
                throw new PanierException('Code invalide');
            }

            if (!$panierDTO->valide){
                throw new PanierException('Panier invalidé');
            }
            $verifDTO = new PanierVerifDTO($numero, $date, $code);
            $valide = $this->panierService->verifier($verifDTO, $panierDTO);

            if ($valide) {
                $this->billetService->payerCommande($idUser);
            }

        }catch (\Exception $e){
            throw new HttpBadRequestException($rq, $e->getMessage());
        }
        return $rs->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}