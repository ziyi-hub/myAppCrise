<?php


namespace crise\controleur;
use crise\models\Utilisateurs;
use crise\vue\VuePrincipale;
use Slim\Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControleurCrise
{
    private $c;
    private $htmlvars;

    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    public function getUtilisateurs(Request $rq, Response $rs, array $args ): Response {
        $liste = Utilisateurs::all();
        if (!is_null($liste)){
            $vue = new VuePrincipale([$liste]);
            $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
            $rs->getBody()->write($vue->getVueUser());
        }
        return $rs;
    }



}