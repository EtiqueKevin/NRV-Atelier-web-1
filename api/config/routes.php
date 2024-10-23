<?php
declare(strict_types=1);

use nrv\application\actions\GetArtisteByIdAction;
use nrv\application\actions\GetLieuxAction;
use nrv\application\actions\GetSoireeByIdAction;
use nrv\application\actions\GetSpectaclesAction;
use nrv\application\actions\GetSpectaclesByIdAction;
use nrv\application\actions\HomeAction;
use nrv\application\actions\RefreshAction;
use nrv\application\actions\SignInAction;
use nrv\application\middlewares\AuthMiddleware;
use nrv\application\middlewares\Cors;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
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

    $app->get('/spectacles/{ID-SPECTACLE}[/]', GetSpectaclesByIdAction::class);

    // artiste

    $app->get('/artiste/{ID-ARTISTE}[/]',GetArtisteByIdAction::class);

    // soiree

    $app->get('/soirees/{ID-SOIREE}[/]', GetSoireeByIdAction::class);

    //lieux

    $app->get('/lieux[/]', GetLieuxAction::class)->add(AuthMiddleware::class);

    // utilisateur

    $app->get('/utilisateur/signin[/]', SignInAction::class);

    $app->get('/utilisateur/signup[/]', HomeAction::class);

    $app->get('/utilisateur/refresh[/]',RefreshAction::class)->add(AuthMiddleware::class);

    // billet

    $app->get('/billets[/]', HomeAction::class);

    //panier
    $app->get('/panier[/]', GetPanierAction::class);

    $app->post('/panier[/]', AddPanierAction::class);

    $app->delete('/panier[/]', DeletePanierAction::class);

    $app->post('/panier/valider[/]', ValiderPanierAction::class);

    return $app;
};