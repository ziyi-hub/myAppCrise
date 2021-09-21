<?php


namespace crise\controleur;
use crise\models\Utilisateurs;
use crise\vue\VuePrincipale;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControleurCrise
{
    private $htmlvars;

    public function __construct()
    {
    }

    public function getUtilisateurs(Request $rq, Response $rs, array $args ): Response {
        $liste = Utilisateurs::all();
        if (!is_null($liste)){
            $vue = new VuePrincipale([$liste]);
            $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
            //$this->htmlvars['basepath'] = $rq->getUri()->getPath();
            $rs->getBody()->write($vue->getVueUser());
        }
        return $rs;
    }

}