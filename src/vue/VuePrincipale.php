<?php


namespace crise\vue;


class VuePrincipale
{
    private $data;
    private $htmlvars;
    private $selecteur;
    private $container;
    const COMPTE_VIEW = 1;
    const ACCUEIL_VIEW = 2;
    const CONNEXION_VIEW = 3;
    const INSCRIPTION_VIEW = 4;

    public function __construct(array $d, $container)
    {
        $this->data = $d;
        $this->container = $container;
    }

    public function getVueUser(){
        $html = "";
        $l = $this->data[0];
        if(is_null($l))
        {
            return "<h2>Liste Inexistante</h2>";
        }

        foreach ($l as $donnees){
            $id = $donnees->idUtilisateur;
            $nom = $donnees->nomUtilisateur;
            $mdp = $donnees->motDePasse;
            $html .=
"<p>
            <strong>ID est</strong> : $id<br />
            nom du l'utilisateur est $nom<br /><em>
            mot de passe est $mdp<br /></em>
</p>";
        }
        return $html;
    }

    public function htmlInscription(){
        return <<< END
            <div class="entete4">
				<div id="inscrit">
                    <h1>Inscription</h1>
                    <form method="post" action="" id="formvalider">
                        <input type="text" name="NomUtilisateur" id="NomUtilisateur" placeholder="Nom d'utilisateur" required>  
                        <div class="div-bor">
                            <input type="password" name="MotDePasse" id="MotDePasse" placeholder="Mot de passe" required>
                            <i class="icon-user" id="icon-user"></i>
                        </div>
                        <div class="div-bor">
                            <input type="password" name="MotDePasse2" id="MotDePasse2" placeholder="Confirmer le mot de passe" required>
                            <i class="icon-user2" id="icon-user2"></i>
                        </div>
                        <button type="submit" class="but" id="submit">Inscription</button>
                         <div id="showmsg" style="display: none"></div>
                    </form>
                    <h3>Un compte? Connectez-vous <a id = 'ici' href="#">ici</a> !</h3>
               </div>		
            </div>
END;
    }


    public function htmlConnexion(){
        return <<<END
			<div class="entete4">
			<div class="contenu">
			    <div id="login">
			        <h1>Connexion</h1>
			        <form method="POST" action="#" id="formvalider">
                        <input type="text" required="required" placeholder="Identifiant" name="user" id="user">
                        <div class="div-bor">
                            <input type="password" required="required" placeholder="Mot de passe" name="password" id="password">
                            <i class="icon-user3" id="icon-user3"></i>
                        </div>
                        <button class="but" type="submit">Connexion</button>
                    </form>
                    <h3>Pas de compte? Inscrivez-vous <a id = 'ici' href="#">ici</a> !</h3>
                </div>
            </div>    		
            </div> 
        <script type="text/javascript" src="#" defer></script>
END;
    }

    public function htmlAccueil(){
        return <<< END
			<div class="entete">
				<h1><div class = "contenu">Welcome to my application</div></h1>
			</div>
END;
    }


    public function render($s, $h){
        $this->selecteur = $s;
        $this->htmlvars = $h;
        $liencss = $this->htmlvars['basepath']."/public/web/css/style.css";
        switch ($this->selecteur) {
            case self::ACCUEIL_VIEW: {
                $content = $this->htmlAccueil();
                break;
            }

            case self::CONNEXION_VIEW: {
                $content = $this->htmlConnexion();
                break;
            }

            case self::INSCRIPTION_VIEW: {
                $content = $this->htmlInscription();
                break;
            }

        }

        return <<< END
<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href=$liencss>
		<title>myJukeBox</title>
	</head>
	<body>
		<header>
			<div class="alignement">
				<div class="logo"></div>
				<div class="container">
					<div class="d"><a href="#">Accueil</a></div>
					<div class="d"><a href="#">Messagerie</a></div>
					<div class="d"><a href="#">Connexion</a></div>
					<div class="d"><a href="#">Inscription</a></div>
				</div>
			</div>
			$content
		</header>
		<footer>
			<div class="bas">
				<div class="contact">Nous contacter</div>
				<span>©2020 myAppCrise | et autres régimes</span>
			</div>
		</footer>
	</body>
</html>
END;

    }
}