<?php

require __DIR__ . '/../vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Selective\BasePath\BasePathMiddleware;
use crise\controleur\ControleurCrise;
use Slim\Factory\AppFactory;

session_start();
$config = require_once '../src/conf/settings.php';
$db = new DB();
$db->addConnection(parse_ini_file($config['settings']['dbfile']));
$db->setAsGlobal();
$db->bootEloquent();
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->add(new BasePathMiddleware($app));
$app->addErrorMiddleware(true, true, true);


$app->get('/',
    function (Request $request, Response $response, $args): Response {
        $controleur = new ControleurCrise(AppFactory::create()->getContainer());
        $response = $controleur->getAccueil($request, $response, $args);
        return $response;
    }
)->setName('accueil');


$app->get('/filtrer/{nom}[/]', function ($request, $response, array $args) {
    $controleur = new ControleurCrise(AppFactory::create()->getContainer());
    $response = $controleur->getUtilisateurs($request, $response, $args);
    return $response;
});


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


$app->run();