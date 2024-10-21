<?php
declare(strict_types=1);

use nrv\application\actions\HomeAction;
use nrv\application\middlewares\Cors;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

return function( App $app): App {

    $app->add(Cors::class);

    $app->options('/{routes:.+}',
        function( Request $rq,
                  Response $rs, array $args) : Response {
            return $rs;
        });

    $app->get('/', HomeAction::class);

    // spectacle

    $app->get('/spectacles[/]', GetSpectaclesAction::class);

    $app->get('/spectacles/soiree/{ID-SPECTACLES}', HomeAction::class);

    // soiree

    $app->get('/soirees/{ID-SOIREE}[/]', HomeAction::class);

    // user

    $app->get('/users/signin[/]', HomeAction::class);

    $app->get('/users/signup[/]', HomeAction::class);

    // billet

    $app->get('/billets[/]', HomeAction::class);

    return $app;
};