<?php
declare(strict_types=1);

use nrv\application\actions\billets\GetBilletsById;
use nrv\application\actions\billets\GetBilletsByIdUtilisateur;
use nrv\application\actions\billets\PostPayerCommandeAction;
use nrv\application\actions\HomeAction;
use nrv\application\actions\panier\AddPanierAction;
use nrv\application\actions\panier\GetPanierAction;
use nrv\application\actions\panier\UpdatePanierAction;
use nrv\application\actions\panier\ValiderPanierAction;
use nrv\application\actions\soirees\GetLieuxAction;
use nrv\application\actions\soirees\GetSoireeByIdAction;
use nrv\application\actions\soirees\GetSoireeByIdBackofficeAction;
use nrv\application\actions\soirees\GetStylesAction;
use nrv\application\actions\soirees\PutSoireeAction;
use nrv\application\actions\spectacles\GetArtisteByIdAction;
use nrv\application\actions\spectacles\GetSpectaclesAction;
use nrv\application\actions\spectacles\GetSpectaclesByIdAction;
use nrv\application\actions\spectacles\PutSpectacleAction;
use nrv\application\actions\utilisateur\RefreshAction;
use nrv\application\actions\utilisateur\SignInAction;
use nrv\application\actions\utilisateur\SignUpAction;
use nrv\application\middlewares\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function( App $app): App {

    //$app->add(Cors::class);

    $app->options('/{routes:.+}',
        function( Request $rq,
                  Response $rs, array $args) : Response {
            return $rs;
        });

    $app->get('/', HomeAction::class)->setName('home');

    // spectacle

    $app->get('/spectacles[/]', GetSpectaclesAction::class)
        ->setName('get_spectacles');

    $app->get('/spectacle/{ID-SPECTACLE}[/]', GetSpectaclesByIdAction::class)
        ->setName('get_spectacle_by_id');

    $app->put('/spectacle[/]',PutSpectacleAction::class)
        ->setName('put_spectacle');;


    // artiste

    $app->get('/artiste/{ID-ARTISTE}[/]', GetArtisteByIdAction::class)
        ->setName('get_artiste_by_id');

    // soiree

    $app->get('/soirees/{ID-SOIREE}[/]', GetSoireeByIdAction::class)
        ->setName('get_soiree_by_id');

    $app->put('/soiree[/]', PutSoireeAction::class)
        ->setName('put_soiree');

    //lieux

    $app->get('/lieux[/]', GetLieuxAction::class)
        ->setName('get_lieux');

    //styles

    $app->get('/styles[/]', GetStylesAction::class)
        ->setName('get_styles');

    // utilisateur

    $app->get('/utilisateur/signin[/]', SignInAction::class)
        ->setName('sign_in');

    $app->post('/utilisateur/signup[/]', SignUpAction::class)
        ->setName('sign_up');

    $app->get('/utilisateur/refresh[/]', RefreshAction::class)
        ->add(AuthMiddleware::class)
        ->setName('refresh_token');

    // billet

    $app->get('/utilisateur/billets[/]', GetBilletsByIdUtilisateur::class)
        ->add(AuthMiddleware::class)
        ->setName('get_billets_by_user');

    $app->get('/utilisateur/billet/{ID-BILLET}', GetBilletsById::class)
        ->add(AuthMiddleware::class)
        ->setName('get_billet_by_id');

    //panier

    $app->get('/panier[/]', GetPanierAction::class)
        ->add(AuthMiddleware::class)
        ->setName('get_panier');

    $app->post('/panier[/]', AddPanierAction::class)
        ->add(AuthMiddleware::class)
        ->setName('add_to_panier');

    $app->post('/panier/valider[/]', ValiderPanierAction::class)
        ->add(AuthMiddleware::class)
        ->setName('validate_panier');

    $app->post('/panier/update[/]', UpdatePanierAction::class)
        ->add(AuthMiddleware::class)
        ->setName('update_panier');

    $app->post('/panier/payer[/]', PostPayerCommandeAction::class)
        ->add(AuthMiddleware::class)
        ->setName('pay_order');

    // backoffice

    $app->get('/backoffice/soirees/{ID-SOIREE}[/]', GetSoireeByIdBackofficeAction::class)
        ->add(AuthMiddleware::class)
        ->setName('get_backoffice_soiree_by_id');

    return $app;
};