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


    /**
     * @param PanierServiceInterface $panierService
     * @param BilletServiceInterface $billetService
     */
    public function __construct(PanierServiceInterface $panierService, BilletServiceInterface $billetService)
    {
        $this->panierService = $panierService;
        $this->billetService = $billetService;
    }


    /**
     * PAYER LA COMMANDE EN VERIFIANT LA VALIDITE DE L'ACTION ET LA VALIDITE DE LA CARTE RENSEIGNEE DANS LE BODY
     * @param ServerRequestInterface $rq
     * @param ResponseInterface $rs
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $idUser = $rq->getAttribute('UtiOutDTO')->id;
        $numero = $rq->getParsedBody()['numero'];
        $dateExpiration = $rq->getParsedBody()['date'];
        $code = $rq->getParsedBody()['code'];


        $numeroValidator = Validator::digit()->length(16, 16);
        $codeValidator = Validator::digit()->length(3, 3);
        $dateExpirationValidator = Validator::callback(function($date) {
            $currentDate = new \DateTime();
            $expirationDate = \DateTime::createFromFormat('m/y', $date);
            return $expirationDate && $expirationDate >= $currentDate;
        });

        try {
            $panierDTO = $this->panierService->getPanier($idUser);

            if (!$numeroValidator->validate($numero)) {
                throw new PanierException('Numero invalide');
            }

            if(!$dateExpirationValidator->validate($dateExpiration) ){
                throw new PanierException('Date d\'expiration invalide');
            }

            if(!$codeValidator->validate($code)){
                throw new PanierException('Code invalide');
            }

            if ((filter_var($numero,
                    FILTER_SANITIZE_FULL_SPECIAL_CHARS)!== $numero ||
                filter_var($dateExpiration,
                    FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $dateExpiration ||
                filter_var($code,
                    FILTER_SANITIZE_FULL_SPECIAL_CHARS) !== $code)) {
                throw new HttpBadRequestException($rq, 'data non valide : validator && sanitize');
            }

            if (!$panierDTO->valide){
                throw new PanierException('Panier invalidé');
            }
            $verifDTO = new PanierVerifDTO($numero, $dateExpiration, $code);
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