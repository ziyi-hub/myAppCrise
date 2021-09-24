<?php


namespace crise\controleur;
use crise\models\Messages;
use crise\models\Utilisateurs;
use crise\vue\VuePrincipale;
use Slim\Routing\RouteContext;
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
            $rs->getBody()->write($vue->getVueUser());
        }
        return $rs;
    }


    function getAccueil(Request $rq, Response $rs, array $args ): Response {
        $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        //$relativeUrl = $routeParser->relativeUrlFor('inscription');
        $inscription = $routeParser->urlFor('inscription');
        $accueil = $routeParser->urlFor('accueil');
        $connexion = $routeParser->urlFor('connexion');
        $validerInscription = $routeParser->urlFor('validerInscription');
        $htmlvars = [
            'basepath' => $basePath,
            'inscription' => $inscription,
            'accueil' => $accueil,
            'connexion' => $connexion,
            'validerInscription' => $validerInscription,
        ];
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(2, $htmlvars));
        return $rs;
    }


    function getInscription(Request $rq, Response $rs, array $args ): Response {
        $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        //$relativeUrl = $routeParser->relativeUrlFor('inscription');
        $inscription = $routeParser->urlFor('inscription');
        $accueil = $routeParser->urlFor('accueil');
        $connexion = $routeParser->urlFor('connexion');
        $validerInscription = $routeParser->urlFor('validerInscription');
        $htmlvars = [
            'basepath' => $basePath,
            'inscription' => $inscription,
            'accueil' => $accueil,
            'connexion' => $connexion,
            'validerInscription' => $validerInscription,
        ];
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(4, $htmlvars));
        return $rs;
    }

    function getConnexion(Request $rq, Response $rs, array $args ): Response {
        $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        //$relativeUrl = $routeParser->relativeUrlFor('validerInscription');
        $inscription = $routeParser->urlFor('inscription');
        $accueil = $routeParser->urlFor('accueil');
        $connexion = $routeParser->urlFor('connexion');
        $validerInscription = $routeParser->urlFor('validerInscription');
        $htmlvars = [
            'basepath' => $basePath,
            'inscription' => $inscription,
            'accueil' => $accueil,
            'connexion' => $connexion,
            'validerInscription' => $validerInscription,
        ];
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(3, $htmlvars));
        return $rs;
    }

    public function validerInscription(Request $rq, Response $rs, array $args ):Response{
        $basePath = \Slim\Routing\RouteContext::fromRequest($rq)->getBasePath();
        $NomUtilisateur = $_POST['NomUtilisateur'];
        $MotDePasse = $_POST['MotDePasse'];
        $MotDePasse2 = $_POST['MotDePasse2'];

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $validerInscription = $routeParser->urlFor('validerInscription');
        $inscription = $routeParser->urlFor('inscription');
        $accueil = $routeParser->urlFor('accueil');
        $connexion = $routeParser->urlFor('connexion');
        $htmlvars = [
            'basepath' => $basePath,
            'inscription' => $inscription,
            'accueil' => $accueil,
            'connexion' => $connexion,
            'validerInscription' => $validerInscription,
        ];

        if (($MotDePasse === $MotDePasse2)&&(strpos($NomUtilisateur, ' ') === false)){
            $hash = password_hash($MotDePasse, PASSWORD_DEFAULT);
            $utilisateur = new Utilisateurs();
            $utilisateur->nomUtilisateur = $NomUtilisateur;
            $utilisateur->motDePasse = $hash;
            $utilisateur->roleId = 1;
            $utilisateur->save();
            echo "<script>alert('Inscription réussie')</script>";
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(3, $htmlvars));
        }elseif ($MotDePasse !== $MotDePasse2){
            echo "<script>alert('Les deux mots de passe doivent être identiques')</script>";
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(4, $htmlvars));
        }else{
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(4, $htmlvars));
        }
        return $rs;
    }

}