<?php


namespace crise\vue;


class VuePrincipale
{
    private $data;
    private $htmlvars;

    public function __construct(array $d)
    {
        $this->data = $d;
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

/*
    public function getVueMes(){
        $html = "";
        $l = $this->data[0];
        if(is_null($l))
        {
            return "<h2>Liste Inexistante</h2>";
        }

        foreach ($l as $donnees){
            $id = $donnees->idMessage;
            $nom = $donnees->content;
            $temps = $donnees->tempsEnvoi;
            $html .=
                "<p>
            <strong>ID est</strong> : $id<br />
            content de message est $nom<br /><em>
            temps envoie est : $temps<br /></em>
</p>";
        }
        return $html;
    }
*/

    public function render($h){
        $this->htmlvars = $h;
        $liencss = $this->htmlvars['basepath']."/public/web/css/style.css";
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
			
			<div class="entete">
				<h1><div class = "contenu">Welcome to my application</div></h1>
			</div>
		</header>
		
		<footer>
			<div class="bas">
				<div class="contact">Nous contacter</div>
				<span>©2020 myJukeBox | et autres régimes</span>
			</div>
		</footer>
	</body>
</html>
END;

    }
}