<?php

require __DIR__ . '/../vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Selective\BasePath\BasePathMiddleware;
use crise\controleur\ControleurCrise;
use Slim\Factory\AppFactory;

session_start();
$db = new DB();
$db->addConnection(
    [
        'host' => 'localhost',
        'con_db_port' => '3306',
        'username' => 'PWeb',
        'password' => '1Zhongguo',
        'database' => 'PWeb',
        'charset' => 'utf8',
        'driver' => 'mysql',
    ]
);
$db->setAsGlobal();
$db->bootEloquent();
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->add(new BasePathMiddleware($app));


// Define Custom Error Handler
$customErrorHandler = function (
    Request $request,
    Throwable $exception
) use ($app) {
    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );

    return $response;
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);



$app->get('/',
    function (Request $request, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getAccueil($request, $response, $args);
        return $response;
    }
)->setName('accueil');


$app->get('/inscription',
    function (Request $request, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getInscription($request, $response, $args);
        return $response;
    }
)->setName('inscription');


$app->get('/connexion',
    function (Request $request, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getConnexion($request, $response, $args);
        return $response;
    }
)->setName('connexion');


$app->post('/validerInscription',
    function (Request $request, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->validerInscription($request, $response, $args);
        return $response;
    }
)->setName('validerInscription');


$app->post('/validerConnexion',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->validerConnexion($req, $response, $args);
        return $response;
    }
)->setName('validerConnexion');


$app->get('/monCompte',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getMonCompte($req, $response, $args);
        return $response;
    }
)->setName('monCompte');


$app->get('/deconnexion',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->deconnexion($req, $response, $args);
        return $response;
    }
)->setName('deconnexion');


$app->post('/modifMotDePasse',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->modifierMotDePasse($req, $response, $args);
        return $response;
    }
)->setName('modifMotDePasse');


$app->get('/contaminee',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getInfoContaminee($req, $response, $args);
        return $response;
    }
)->setName('contaminee');


$app->get('/filtrer',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getFiltrer($req, $response, $args);
        return $response;
    }
)->setName('filtrer');

$app->get('/monCompte/{token}',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getMonCompte($req, $response, $args);
        return $response;
    }
)->setName('monCompte/{token}');

$app->get('/messagerie',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getMessagerie($req, $response, $args);
        return $response;
    }
)->setName('messagerie');

$app->run();