<?php

use nrv\application\actions\billets\GetBilletsById;
use nrv\application\actions\billets\GetBilletsByIdUtilisateur;
use nrv\application\actions\panier\AddPanierAction;
use nrv\application\actions\panier\GetPanierAction;
use nrv\application\actions\panier\ModifierPanierAction;
use nrv\application\actions\panier\ValiderPanierAction;
use nrv\application\actions\soirees\GetLieuxAction;
use nrv\application\actions\soirees\GetSoireeByIdAction;
use nrv\application\actions\soirees\GetSoireeByIdBackofficeAction;
use nrv\application\actions\soirees\GetSoireesAction;
use nrv\application\actions\soirees\PostSoireeAction;
use nrv\application\actions\spectacles\GetArtisteByIdAction;
use nrv\application\actions\spectacles\GetArtistesAction;
use nrv\application\actions\spectacles\GetSpectaclesAction;
use nrv\application\actions\spectacles\GetSpectaclesByIdAction;
use nrv\application\actions\spectacles\PostSpectacleAction;
use nrv\application\actions\utilisateur\SignInAction;
use nrv\application\actions\utilisateur\SignUpAction;
use nrv\application\middlewares\AuthMiddleware;
use nrv\application\middlewares\AuthorizationBackMiddleware;
use nrv\application\middlewares\AuthorizationLambdaMiddleware;
use nrv\application\providers\auth\AuthProvider;
use nrv\application\providers\auth\AuthProviderInterface;
use nrv\application\providers\auth\JWTManager;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;
use nrv\core\repositroryInterfaces\UtilisateursRepositoryInterface;
use nrv\core\services\artiste\ArtisteService;
use nrv\core\services\artiste\ArtisteServiceInterface;
use nrv\core\services\authorization\AuthzUtilisateurInterface;
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
use nrv\core\services\authorization\AuthorizationService;
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
        return new SoireeService($c->get(SoireesRepositoryInterface::class),$c->get(UtilisateursRepositoryInterface::class),$c->get('logger'));
    },

    SpectacleServiceInterface::class => function (ContainerInterface $c) {
        return new SpectacleService($c->get(SoireesRepositoryInterface::class),$c->get('logger'));
    },

    PanierServiceInterface::class => function (ContainerInterface $c) {
        return new PanierService($c->get(UtilisateursRepositoryInterface::class), $c->get(SoireesRepositoryInterface::class),$c->get('logger'));
    },

    UtilisateurServiceInterface::class => function (ContainerInterface $c) {
        return new UtilisateurService($c->get(UtilisateursRepositoryInterface::class),$c->get('logger'));
    },

    BilletServiceInterface::class => function (ContainerInterface $c) {
    return new BilletService($c->get(UtilisateursRepositoryInterface::class),$c->get(SoireesRepositoryInterface::class),$c->get('logger'));
    },

    AuthzUtilisateurInterface::class => function (ContainerInterface $c) {
        return new AuthorizationService($c->get(UtilisateursRepositoryInterface::class));
    },

    // PROVIDERS

    AuthProviderInterface::class => function(ContainerInterface $c){
        return new AuthProvider($c->get(UtilisateurServiceInterface::class),$c->get(JWTManager::class));
    },

    ArtisteServiceInterface::class=> function (ContainerInterface $c) {
        return new ArtisteService($c->get(SoireesRepositoryInterface::class),$c->get('logger'));
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

    GetSoireeByIdBackofficeAction::class=> function (ContainerInterface $c) {
        return new GetSoireeByIdBackofficeAction($c->get(SoireeServiceInterface::class));
    },

    ModifierPanierAction::class => function (ContainerInterface $c) {
        return new ModifierPanierAction($c->get(PanierServiceInterface::class));
    },

    PostSoireeAction::class => function (ContainerInterface $c) {
        return new PostSoireeAction($c->get(SoireeServiceInterface::class));
    },

    PostSpectacleAction::class => function (ContainerInterface $c) {
        return new PostSpectacleAction($c->get(SpectacleServiceInterface::class));
    },

    GetArtistesAction::class => function (ContainerInterface $c) {
        return new GetArtistesAction($c->get(ArtisteServiceInterface::class));
    },

    GetSoireesAction::class=> function (ContainerInterface $c) {
        return new GetSoireesAction($c->get(SoireeServiceInterface::class));
    },

    // MIDDLEWARES

    AuthMiddleware::class => function (ContainerInterface $c) {
        return new AuthMiddleware($c->get(AuthProviderInterface::class));
    },

    AuthorizationBackMiddleware::class => function (ContainerInterface $c) {
        return new AuthorizationBackMiddleware($c->get(AuthzUtilisateurInterface::class));
    },

    AuthorizationLambdaMiddleware::class => function (ContainerInterface $c) {
        return new AuthorizationLambdaMiddleware($c->get(AuthzUtilisateurInterface::class));
    },
];