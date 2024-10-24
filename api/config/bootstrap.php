<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Slim\Psr7\Response as SlimResponse;

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use nrv\application\middlewares\Cors;
$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/settings.php' );
$builder->addDefinitions(__DIR__ . '/dependencies.php');

$c=$builder->build();
$app = AppFactory::createFromContainer($c);


$app->addBodyParsingMiddleware();
$app->add(Cors::class);
$app->addRoutingMiddleware();

//$app->addErrorMiddleware($c->get('displayErrorDetails'), false, false);

$errorMiddleware = $app->addErrorMiddleware(true, false, false);
$errorMiddleware->setDefaultErrorHandler(
    function (Request $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) {
        $statusCode = $exception->getCode();
        if($statusCode === 0){
            $statusCode = 500;
        }
        $errorMessage = $exception->getMessage();

        $response = new SlimResponse();

        $response = $response->withHeader('Access-Control-Allow-Origin', '*')
                             ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                             ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        $errorDetails = [
            'ok' => false,
            'error' => $errorMessage,
            'status' => $statusCode,
            'timestamp' => (new DateTime())->format(DateTime::ATOM),
            'path' => (string)$request->getUri()
        ];

        $response->getBody()->write(json_encode($errorDetails, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        return $response->withStatus($statusCode)
                ->withHeader('Content-Type', 'application/json');
    }
);

$app = (require_once __DIR__ . '/routes.php')($app);
$routeParser = $app->getRouteCollector()->getRouteParser();


return $app;