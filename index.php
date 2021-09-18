<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use crise\controleur\ControleurCrise;


$config = require_once 'src/conf/settings.php';

$c = new \Slim\Container($config);

$db = new DB();
$db->addConnection(parse_ini_file($config['settings']['dbfile']));
$db->setAsGlobal();
$db->bootEloquent();

$app = new \Slim\App($c);


$app->get('/',
    function (Request $req, Response $response, $args): Response {
        $controleur = new ControleurCrise($this);
        $response = $controleur->getUtilisateurs($req, $response, $args);
        return $response;
    }
)->setName('accueil');


$app->run();