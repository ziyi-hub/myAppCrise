<?php


namespace crise\controleur;
use crise\models\Profil;
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


    public function initiale(Request $rq, Response $rs, array $args ): Response {
        $basePath = RouteContext::fromRequest($rq)->getBasePath();
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $inscription = $routeParser->urlFor('inscription');
        $accueil = $routeParser->urlFor('accueil');
        $connexion = $routeParser->urlFor('connexion');
        $monCompte = $routeParser->urlFor('monCompte');
        $validerInscription = $routeParser->urlFor('validerInscription');
        $validerConnexion = $routeParser->urlFor('validerConnexion');
        $this->htmlvars = [
            'basepath' => $basePath,
            'inscription' => $inscription,
            'accueil' => $accueil,
            'connexion' => $connexion,
            'validerInscription' => $validerInscription,
            'monCompte' => $monCompte,
            'validerConnexion' => $validerConnexion,
        ];
        return $rs;
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
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(2, $this->htmlvars));
        return $rs;
    }


    function getInscription(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(4, $this->htmlvars));
        return $rs;
    }


    function getConnexion(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(3, $this->htmlvars));
        return $rs;
    }


    public function validerInscription(Request $rq, Response $rs, array $args ):Response{
        $this->initiale($rq, $rs, $args);
        $NomUtilisateur = $_POST['NomUtilisateur'];
        $MotDePasse = $_POST['MotDePasse'];
        $MotDePasse2 = $_POST['MotDePasse2'];

        if (($MotDePasse === $MotDePasse2)&&(strpos($NomUtilisateur, ' ') === false)){
            $hash = password_hash($MotDePasse, PASSWORD_DEFAULT);
            $utilisateur = new Utilisateurs();
            $profil = new Profil();
            $utilisateur->nomUtilisateur = $NomUtilisateur;
            $utilisateur->motDePasse = $hash;
            $utilisateur->roleId = 1;
            $profil->roleId = 1;
            $profil->codeProfil = "admin";
            $profil->save();
            $utilisateur->idProfil = $profil->idProfil;
            $utilisateur->save();

            echo "<script>alert('Inscription réussie')</script>";
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(3, $this->htmlvars));
        }elseif ($MotDePasse !== $MotDePasse2){
            echo "<script>alert('Les deux mots de passe doivent être identiques')</script>";
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(4, $this->htmlvars));
        }else{
            echo "<script>alert('Compte n\'existe pas')</script>";
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(4, $this->htmlvars));
        }
        return $rs;
    }


    public function validerConnexion(Request $rq, Response $rs, array $args ):Response{
        $this->initiale($rq, $rs, $args);
        $Login = $_POST['user'];
        $password = $_POST['password'];
        $eloquentResult = Utilisateurs::query()
            ->where('nomUtilisateur','=', $Login)
            ->firstOr();

        if (!is_null($eloquentResult) && password_verify($password, $eloquentResult->motDePasse) === true) {
            $user = Utilisateurs::find($eloquentResult->idUtilisateur);

            if(empty($_SESSION['profile'])){
                $_SESSION['profile'] = array(
                    'id'         => $user->idUtilisateur,
                    'username'   => $user->nomUtilisateur,
                    'role_id'    => $user->roleId,
                    'mdp'        => $user->motDePasse,
                );
            }
            $vue = new VuePrincipale([$eloquentResult], $this->container);
            $rs->getBody()->write($vue->renderConnecte(1, $this->htmlvars));
        }else{
            echo "<script>alert('Attention! Le mot de passe incorrect! ')</script>";
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(3, $this->htmlvars));
        }
        return $rs;
    }


    public function getMonCompte(Request $rq, Response $rs, array $args ):Response{
        $this->initiale($rq, $rs, $args);
        if ($_SESSION['profile']['id'] ?? ''){
            $eloquentResult = Utilisateurs::query()
                ->where('idUtilisateur', '=', $_SESSION['profile']['id'])
                ->firstOr();
            if (!is_null($eloquentResult)) {
                $vue = new VuePrincipale([$eloquentResult], $this->container);
                $rs->getBody()->write($vue->renderConnecte(1, $this->htmlvars));
            }
        }else{
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(3, $this->htmlvars));
        }
        return $rs;
    }


}