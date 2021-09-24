<?php


namespace crise\controleur;
use crise\models\Messages;
use crise\models\Utilisateurs;
use crise\vue\VuePrincipale;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControleurCrise
{
    private $htmlvars;
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }


    public function getUtilisateurs(Request $rq, Response $rs, array $args ): Response {
        $liste = Utilisateurs::all();
        if (!is_null($liste)){
            $vue = new VuePrincipale([$liste], $this->container);
            //$basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
            $rs->getBody()->write($vue->getVueUser());
        }
        return $rs;
    }


    function getAccueil(Request $rq, Response $rs, array $args ): Response {
        $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
        $htmlvars = [
            'basepath' => $basePath,
        ];
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(2, $htmlvars));
        return $rs;
    }


    function getInscription(Request $rq, Response $rs, array $args ): Response {
        $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
        $htmlvars = [
            'basepath' => $basePath,
        ];
        $vue = new VuePrincipale([]);
        $rs->getBody()->write($vue->render(4, $htmlvars));
        return $rs;
    }

}