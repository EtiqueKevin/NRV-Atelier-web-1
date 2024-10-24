<?php

use nrv\application\actions\AddPanierAction;
use nrv\application\actions\GetArtisteByIdAction;
use nrv\application\actions\GetBilletsById;
use nrv\application\actions\GetBilletsByIdUtilisateur;
use nrv\application\actions\GetLieuxAction;
use nrv\application\actions\GetPanierAction;
use nrv\application\actions\GetSoireeByIdAction;
use nrv\application\actions\GetSpectaclesAction;
use nrv\application\actions\GetSpectaclesByIdAction;
use nrv\application\actions\SignInAction;
use nrv\application\actions\SignUpAction;
use nrv\application\actions\ValiderPanierAction;
use nrv\application\middlewares\AuthMiddleware;
use nrv\application\providers\auth\AuthProvider;
use nrv\application\providers\auth\AuthProviderInterface;
use nrv\application\providers\auth\JWTManager;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use nrv\core\services\billet\BilletService;
use nrv\core\services\billet\BilletServiceInterface;
use nrv\core\services\Panier\PanierService;
use nrv\core\services\Panier\PanierServiceInterface;
use nrv\core\services\soiree\SoireeService;
use nrv\core\services\soiree\SoireeServiceInterface;
use nrv\core\services\spectacle\SpectacleService;
use nrv\core\services\spectacle\SpectacleServiceInterface;
use nrv\core\services\utilisateur\UtilisateurService;
use nrv\core\services\utilisateur\UtilisateurServiceInterface;
use nrv\infrastructure\repositories\PDOSoireeRepository;
use nrv\infrastructure\repositories\PDOUtilisateurRepository;
use Psr\Container\ContainerInterface;


return [

    // REPOSITORY

    SoireesRepositoryInterface::class  => function (ContainerInterface $c){
        return new PDOSoireeRepository($c->get('soirees.pdo'));
    },

    UtilisateursRepositoryInterface::class => function (ContainerInterface $c){
        return new PDOUtilisateurRepository($c->get('utilisateurs.pdo'));
    },

    // JWT

    JWTManager::class => function(ContainerInterface $c){
        return new JWTManager($c->get('SECRET_KEY'));
    },

    // SERVICES

    SoireeServiceInterface::class => function (ContainerInterface $c) {
        return new SoireeService($c->get(SoireesRepositoryInterface::class));
    },

    SpectacleServiceInterface::class => function (ContainerInterface $c) {
        return new SpectacleService($c->get(SoireesRepositoryInterface::class));
    },

    PanierServiceInterface::class => function (ContainerInterface $c) {
        return new PanierService($c->get(UtilisateursRepositoryInterface::class), $c->get(SoireesRepositoryInterface::class));
    },

    UtilisateurServiceInterface::class => function (ContainerInterface $c) {
        return new UtilisateurService($c->get(UtilisateursRepositoryInterface::class));
    },

    BilletServiceInterface::class => function (ContainerInterface $c) {
    return new BilletService($c->get(UtilisateursRepositoryInterface::class),$c->get(SoireesRepositoryInterface::class));
},

    // PROVIDERS

    AuthProviderInterface::class => function(ContainerInterface $c){
        return new AuthProvider($c->get(UtilisateurServiceInterface::class),$c->get(JWTManager::class));
    },

    // ACTIONS

    GetSoireeByIdAction::class => function (ContainerInterface $c) {
        return new GetSoireeByIdAction($c->get(SoireeServiceInterface::class));
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

    GetLieuxAction::class => function (ContainerInterface $c) {
        return new GetLieuxAction($c->get(SoireeServiceInterface::class));
    },

    GetPanierAction::class => function (ContainerInterface $c) {
        return new GetPanierAction($c->get(PanierServiceInterface::class));
    },

    AddPanierAction::class => function (ContainerInterface $c) {
        return new AddPanierAction($c->get(PanierServiceInterface::class));
    },

    ValiderPanierAction::class => function (ContainerInterface $c) {
        return new ValiderPanierAction($c->get(PanierServiceInterface::class));
    },

    SignInAction::class => function(ContainerInterface $c){
        return new SignInAction($c->get(AuthProviderInterface::class));
    },

    SignUpAction::class => function (ContainerInterface $c) {
        return new SignUpAction($c->get(UtilisateurServiceInterface::class));
    },

    GetBilletsByIdUtilisateur::class => function (ContainerInterface $c) {
        return new GetBilletsByIdUtilisateur($c->get(BilletServiceInterface::class));
    },

    GetBilletsById::class =>function (ContainerInterface $c) {
        return new GetBilletsById($c->get(BilletServiceInterface::class),$c->get(UtilisateurServiceInterface::class));
    },

    // MIDDLEWARES

    AuthMiddleware::class => function (ContainerInterface $c) {
        return new AuthMiddleware($c->get(AuthProviderInterface::class));
    },
];