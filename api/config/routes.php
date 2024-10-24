<?php
declare(strict_types=1);

use nrv\application\actions\billets\GetBilletsById;
use nrv\application\actions\billets\GetBilletsByIdUtilisateur;
use nrv\application\actions\billets\PostPayerCommandeAction;
use nrv\application\actions\HomeAction;
use nrv\application\actions\panier\AddPanierAction;
use nrv\application\actions\panier\GetPanierAction;
use nrv\application\actions\panier\ValiderPanierAction;
use nrv\application\actions\soirees\GetLieuxAction;
use nrv\application\actions\soirees\GetSoireeByIdAction;
use nrv\application\actions\soirees\GetSoireeByIdBackofficeAction;
use nrv\application\actions\soirees\GetStylesAction;
use nrv\application\actions\soirees\PutSoireeAction;
use nrv\application\actions\spectacles\GetArtisteByIdAction;
use nrv\application\actions\spectacles\GetSpectaclesAction;
use nrv\application\actions\spectacles\GetSpectaclesByIdAction;
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

    $app->get('/', HomeAction::class);

    // spectacle

    $app->get('/spectacles[/]', GetSpectaclesAction::class);

    $app->get('/spectacle/{ID-SPECTACLE}[/]', GetSpectaclesByIdAction::class);

    // artiste

    $app->get('/artiste/{ID-ARTISTE}[/]',GetArtisteByIdAction::class);

    // soiree

    $app->get('/soirees/{ID-SOIREE}[/]', GetSoireeByIdAction::class);

    $app->put('/soirees[/]', PutSoireeAction::class);

    //lieux

    $app->get('/lieux[/]', GetLieuxAction::class);

    //styles

    $app->get('/styles[/]', GetStylesAction::class);

    // utilisateur

    $app->get('/utilisateur/signin[/]', SignInAction::class);

    $app->post('/utilisateur/signup[/]', SignUpAction::class);

    $app->get('/utilisateur/refresh[/]',RefreshAction::class)->add(AuthMiddleware::class);

    // billet

    $app->get('/billets[/]', HomeAction::class);

    $app->get('/utilisateur/billets[/]', GetBilletsByIdUtilisateur::class)->add(AuthMiddleware::class);

    $app->get('/utilisateur/billet/{ID-BILLET}', GetBilletsById::class)->add(AuthMiddleware::class);

    //panier

    $app->get('/panier[/]', GetPanierAction::class)->add(AuthMiddleware::class);

    $app->post('/panier[/]', AddPanierAction::class)->add(AuthMiddleware::class);

    $app->post('/panier/valider[/]', ValiderPanierAction::class)->add(AuthMiddleware::class);

    $app->post('/panier/update[/]',HomeAction::class)->add(AuthMiddleware::class);

    $app->post('/panier/payer[/]', PostPayerCommandeAction::class)->add(AuthMiddleware::class);

    // backoffice

    $app->get('/backoffice/soirees/{ID-SOIREE}[/]',GetSoireeByIdBackofficeAction::class)->add(AuthMiddleware::class);

    return $app;
};