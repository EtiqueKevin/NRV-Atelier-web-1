<?php

use nrv\application\actions\GetArtisteByIdAction;
use nrv\application\actions\GetSoireeByIdAction;
use nrv\application\actions\GetSoireeBySpectacleAction;
use nrv\application\actions\GetSpectaclesAction;
use nrv\application\actions\GetSpectaclesByIdAction;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use nrv\core\services\soiree\SoireeService;
use nrv\core\services\soiree\SoireeServiceInterface;
use nrv\core\services\spectacle\SpectacleService;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use nrv\infrastructure\repositories\PDOSoireeRepository;
use nrv\infrastructure\repositories\PDOUtilisateurRepository;
use Psr\Container\ContainerInterface;


return [

    SoireesRepositoryInterface::class  => function (ContainerInterface $c){
        return new PDOSoireeRepository($c->get('soirees.pdo'));
    },

    UtilisateursRepositoryInterface::class => function (ContainerInterface $c){
        return new PDOUtilisateurRepository($c->get('utilisateurs.pdo'));
    },

    SoireeServiceInterface::class => function (ContainerInterface $c) {
        return new SoireeService($c->get(SoireesRepositoryInterface::class));
    },

    SpectacleServiceInterface::class => function (ContainerInterface $c) {
        return new SpectacleService($c->get(SoireesRepositoryInterface::class));
    },

    GetSoireeByIdAction::class => function (ContainerInterface $c) {
        return new GetSoireeByIdAction($c->get(SoireeServiceInterface::class));
    },

    GetSoireeBySpectacleAction::class => function (ContainerInterface $c) {
        return new GetSoireeBySpectacleAction($c->get(SoireeServiceInterface::class));
    },

    GetSpectaclesAction::class => function (ContainerInterface $c) {
        return new GetSpectaclesAction($c->get(SpectacleServiceInterface::class));
    },

    GetSpectaclesByIdAction::class => function (ContainerInterface $c) {
        return new GetSpectaclesByIdAction($c->get(SpectacleServiceInterface::class));
    },

    GetArtisteByIdAction::class => function (ContainerInterface $c) {
        return new GetArtisteByIdAction($c->get(SpectacleServiceInterface::class));
    },

];