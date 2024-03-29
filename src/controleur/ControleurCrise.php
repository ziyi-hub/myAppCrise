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
        $deconnexion = $routeParser->urlFor('deconnexion');
        $modifMotDePasse = $routeParser->urlFor('modifMotDePasse');
        $filtrer = $routeParser->urlFor('filtrer');
        $groupe = $routeParser->urlFor('groupe');
        $localisation = $routeParser->urlFor('localisation');

        $this->htmlvars = [
            'basepath' => $basePath,
            'inscription' => $inscription,
            'accueil' => $accueil,
            'connexion' => $connexion,
            'validerInscription' => $validerInscription,
            'monCompte' => $monCompte,
            'validerConnexion' => $validerConnexion,
            'deconnexion' => $deconnexion,
            'modifMotDePasse' => $modifMotDePasse,
            'filtrer' => $filtrer,
            'groupe' => $groupe,
            'localisation' => $localisation,
        ];
        return $rs;
    }

    public function getGroupe(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->renderConnecte(8, $this->htmlvars));
        return $rs;
    }


    public function getFiltrer(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->renderConnecte(7, $this->htmlvars));
        return $rs;
    }


    public function getLocal(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->renderConnecte(9, $this->htmlvars));
        return $rs;
    }


    public function getAccueil(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        if(!empty($_SESSION['profile'])){
            $rs->getBody()->write($vue->renderConnecte(2, $this->htmlvars));
        }else{
            $rs->getBody()->write($vue->render(2, $this->htmlvars));
        }
        return $rs;
    }


    public function getInscription(Request $rq, Response $rs, array $args ): Response {
        $this->initiale($rq, $rs, $args);
        $vue = new VuePrincipale([], $this->container);
        $rs->getBody()->write($vue->render(4, $this->htmlvars));
        return $rs;
    }


    public function getConnexion(Request $rq, Response $rs, array $args ): Response {
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
        $statut = $_POST['statut'];

        if (($MotDePasse === $MotDePasse2)&&(strpos($NomUtilisateur, ' ') === false)){
            $hash = password_hash($MotDePasse, PASSWORD_DEFAULT);
            $utilisateur = new Utilisateurs();
            $profil = new Profil();
            $utilisateur->nomUtilisateur = $NomUtilisateur;
            $utilisateur->motDePasse = $hash;
            $utilisateur->roleId = 1;
            $profil->statutContamine = $statut;
            $profil->roleId = 1;
            $profil->codeProfil = "admin";
            $profil->save();
            $utilisateur->idProfil = $profil->idProfil;
            $utilisateur->save();
            $vue = new VuePrincipale([], $this->container);
            $rs->getBody()->write($vue->render(3, $this->htmlvars));
        }elseif ($MotDePasse !== $MotDePasse2){
            if(empty($_SESSION['erreur']['inscription'])){
                $_SESSION['erreur'] = array(
                    'inscription'         => "Les deux mots de passe doivent être identiques!",
                );
            }
            return $rs->withHeader('Location', $this->htmlvars['inscription'])->withStatus(302);

        }else{
            return $rs->withHeader('Location', $this->htmlvars['inscription'])->withStatus(302);
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

            if (!empty($eloquentResult) && password_verify($password, $eloquentResult->motDePasse) === true) {
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
                return $rs->withHeader('Location', $this->htmlvars['monCompte'])->withStatus(302);
            }else{
                if(empty($_SESSION['erreur']['connexion'])){
                    $_SESSION['erreur'] = array(
                        'connexion'         => "Attention! Le mot de passe incorrect! ",
                    );
                }
                return $rs->withHeader('Location', $this->htmlvars['connexion'])->withStatus(302);
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


    public function modifierMotDePasse(Request $rq, Response $rs, array $args ):Response{
        $this->initiale($rq, $rs, $args);
        $AncienMdp = $_POST['amdp'];
        $MotDePasse = $_POST['mdp'];
        if ($_SESSION['profile']['id'] ?? ''){
            $eloquentResult = Utilisateurs::query()
                ->where('idUtilisateur', '=', $_SESSION['profile']['id'])
                ->firstOr();
            if (password_verify($AncienMdp, $eloquentResult->motDePasse) === true){
                $eloquentResult->motDePasse = password_hash($MotDePasse, PASSWORD_DEFAULT);
                $eloquentResult->save();
                session_unset();
                return $rs->withHeader('Location', $this->htmlvars['connexion'])->withStatus(302);
            }else{
                if(empty($_SESSION['erreur']['modification'])){
                    $_SESSION['erreur'] = array(
                        'modification'         => "Attention! Ancien mot de passe incorrect! ",
                    );
                }
                return $rs->withHeader('Location', $this->htmlvars['monCompte'])->withStatus(302);
            }
        }
        return $rs;
    }


    public function deconnexion(Request $rq, Response $rs, array $args ):Response{
        $this->initiale($rq, $rs, $args);
        if($_SESSION['profile']['id'] ?? '')
        {
            session_unset();
        }
        return $rs->withHeader('Location', $this->htmlvars['connexion'])->withStatus(302);
    }


}