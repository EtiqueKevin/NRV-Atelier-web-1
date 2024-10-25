<?php

namespace nrv\application\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

 class HomeAction extends AbstractAction{


    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {


        $routes = [
            ['method' => 'GET', 'route' => '/', 'action' => 'HomeAction'],

            // Spectacles
            ['method' => 'GET', 'route' => '/spectacles', 'action' => 'GetSpectaclesAction'],
            ['method' => 'GET', 'route' => '/spectacle/{ID-SPECTACLE}', 'action' => 'GetSpectaclesByIdAction'],
            ['method' => 'POST', 'route' => '/spectacles', 'action' => 'PostSpectacleAction'],

            // Artiste
            ['method' => 'GET', 'route' => '/artiste/{ID-ARTISTE}', 'action' => 'GetArtisteByIdAction'],
            ['method' => 'GET', 'route' => '/artistes', 'action' => 'GetArtistesAction'],

            // Soirée
            ['method' => 'GET', 'route' => '/soirees', 'action' => 'GetSoireesAction'],
            ['method' => 'GET', 'route' => '/soirees/{ID-SOIREE}', 'action' => 'GetSoireeByIdAction'],
            ['method' => 'POST', 'route' => '/soiree', 'action' => 'PostSoireeAction' => 'middleware' => ['AuthMiddleware', 'AuthorizationBackMiddleware']],

            // Lieux
            ['method' => 'GET', 'route' => '/lieux', 'action' => 'GetLieuxAction'],

            // Styles
            ['method' => 'GET', 'route' => '/styles', 'action' => 'GetStylesAction'],

            // Utilisateur
            ['method' => 'GET', 'route' => '/utilisateur/signin', 'action' => 'SignInAction'],
            ['method' => 'POST', 'route' => '/utilisateur/signup', 'action' => 'SignUpAction'],
            ['method' => 'GET', 'route' => '/utilisateur/refresh', 'action' => 'RefreshAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],

            // Billet
            ['method' => 'GET', 'route' => '/billet/{ID-BILLET}', 'action' => 'GetBilletByIdAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],
            ['method' => 'POST', 'route' => '/billet', 'action' => 'PostBilletAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],

            // Panier
            ['method' => 'GET', 'route' => '/panier', 'action' => 'GetPanierAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],
            ['method' => 'POST', 'route' => '/panier', 'action' => 'AddPanierAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],
            ['method' => 'POST', 'route' => '/panier/valider', 'action' => 'ValiderPanierAction', 'middleware' => ['AuthMiddleware' , 'AuthorizationLambdaMiddleware']],
            ['method' => 'PUT', 'route' => '/panier/modifier', 'action' => 'ModifierPanierAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],
            ['method' => 'POST', 'route' => '/panier/payer', 'action' => 'PostPayerCommandeAction', 'middleware' => ['AuthMiddleware', 'AuthorizationLambdaMiddleware']],

            // Backoffice
            ['method' => 'GET', 'route' => '/backoffice/soirees/{ID-SOIREE}', 'action' => 'GetSoireeByIdBackofficeAction', 'middleware' => ['AuthMiddleware', 'AuthorizationBackMiddleware']],
        ];

        $html = '<h1>Liste des routes NRV.API</h1>';
        $html .= '<style>
                table {
                    width: 100%;
                }
                th, td {
                    padding: 2px 5px;
                    border-bottom: 1px solid #dddddd;
                }
                th {
                    background-color: #007BFF;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                tr:nth-child(odd) {
                    background-color: #ffffff;
                }
                tr:hover {
                    background-color: #554c4c;
                    color:white;
                }
                h1 {
                    text-align: center;
                }
            </style>';
        $html .= '<table>';
        $html .= '<tr><th>Méthode</th><th>Route</th><th>Action</th><th>Middleware</th></tr>';

        foreach ($routes as $route) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($route['method']) . '</td>';
            $html .= '<td>' . htmlspecialchars($route['route']) . '</td>';
            $html .= '<td>' . htmlspecialchars($route['action']) . '</td>';

            $middlewareList = '';
            if (isset($route['middleware'])) {
                foreach ($route['middleware'] as $m){
                    $middlewareList .= $m. ' ';
                }
            } else {
                $middlewareList = '-';
            }
            $html .= '<td>' .$middlewareList.'</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        $rs->getBody()->write($html);
        return $rs->withStatus(200)->withHeader('Content-Type', 'text/html');
    }

}