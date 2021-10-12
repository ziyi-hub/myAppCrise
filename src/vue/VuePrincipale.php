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
    const InfoContaminee_VIEW = 6;
    const Filtrer_VIEW = 7;
    const MESSAGERIE_VIEW = 8;

    public function __construct(array $d, $container)
    {
        $this->data = $d;
        $this->container = $container;
    }


    private function AfficherIden() {
        $l = $this->data[0];
        if ($l->RoleID === 2){
            $html = <<<END
<div class="infoProfil">PROFIL #N°$l->idProfil<div class="infoProfil_item">$l->nomUtilisateur</div>Administrateur</div>
END;
        }else{
            $html = <<<END
<div class="infoProfil">PROFIL #N°$l->idProfil<div class="infoProfil_item">$l->nomUtilisateur</div>Utilisateur-inscrit</div>
END;
        }
        return $html;
    }

    private function VerifAdmi() {
        $html = null;
        if (!empty($_SESSION["profile"])){
            $monCompte = $this->htmlvars['monCompte']."/".$_SESSION['token'];
            $deconnexion = $this->htmlvars['deconnexion'];
            $contaminee = $this->htmlvars['contaminee'];
            $html = <<<END
<li><div id="triangle"></div></li>
<li><a href=$monCompte>Mon Compte</a></li>
<li><a href=$contaminee>InfoContaminée</a></li>
<li><a href=$deconnexion>Déconnexion</a></li>
END;
        }
        return $html;
    }


    private function myAppCrise() {
        $html = null;
        if (!empty($_SESSION["profile"])){
            $filtrer = $this->htmlvars['filtrer'];
            $messagerie = $this->htmlvars['messagerie'];
            $html = <<<END
<li><div id="triangle"></div></li>
<li><a href=$filtrer>Filtrer</a></li>
<li><a href=$messagerie>Messagerie</a></li>
<li><a href="#">Localisation</a></li>
END;
        }
        return $html;
    }

    public function htmlMessagerie(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/messagerie.js";
        return <<< END
<div class="entete">
<div class="filtrer2">
    <div class="menu"></div>
    <div class="contain">
        <div class="left">
                <div class="top" style="padding: 20px 29px;height: auto;">
                    <div class="" style="font: 13px Arial; ">nombre total : <span id="numbers">0</span></div>
                </div>
                <ul class="people"></ul>
        </div>
        <div class="right">
                <div class="top"><span>Tips: <span class="name">websocke--group</span></span></div>
                <div class="chat active-chat" data-chat="person1"
                     style="border-width: 0;padding: 10px;height: 483px; padding: 10px;overflow-y: auto;scrollTop: 100px">
                </div>
                <div class="write">
                    <a href="" class="write-link attach"></a>
                    <input type="text" id="input-value"/>
                    <a href="" class="write-link smiley"></a>
                    <a href="" class="write-link send"></a>
                </div>
        </div>
        <div id="lightbox" style="display: none; height: 50%; width: 50%; border : 5px solid gray; background-color: papayawhip; z-index: 999"></div>
    </div>
</div>
</div>
<script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlFiltrer(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/filtrer.js";
        $filtrer = $this->htmlvars['filtrer'];
        return <<< END
<div class="entete">
    <div class="filtrer">
        <form action=$filtrer method="get">
            <input type="text" name="keywords" id="keywords" placeholder="Rechercher / Ajouter un ami">
            <input type="submit" name="submit" id="submit" class="submit-chercher" value="Effacer">
            <div id="showmsg"></div>
        </form>
        <div class="messagerie-total">
            <div class="messagerie-user"></div>
            <div class="messagerie-message">
                <div class="messagerie-chat"></div>
                <input type="text" class="messagerie-content" placeholder="Envoyer un message à lui">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlContaminee(){
        return <<< END
            <div class="entete">
				<div class="monCompte">
                    <div id="login">
                        <h2>Indication contaminée</h2>
                        <form method="post" action="#" id="formvalider">
                            <h4>Avez-vous eu une infection Covid-19 symptomatique ?</h4>
                            <div class="radio">
                                <label>oui</label><input type="radio" name="conversion1" value="oui" >
                                <label>non</label><input type="radio" name="conversion1" value="non" >
                            </div>
                            
                            <h4>Avez-vous reçu un vaccin ? </h4>
                            <div class="radio">
                                <label>oui</label><input type="radio" name="conversion2" value="oui" >
                                <label>non</label><input type="radio" name="conversion2" value="non" >
                            </div>
                            <button type="submit" class="but" id="submit">Envoyer</button>
                        </form> 
                    </div>                     
                </div>	
            </div>
END;
    }


    public function htmlInscription(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/inscription.js";
        $connexion = $this->htmlvars['connexion'];
        $action = $this->htmlvars['validerInscription'];
        return <<< END
            <div class="entete4">
				<div id="inscrit">
                    <h1>Inscription</h1>
                    <form method="post" action="$action" id="formvalider">
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
                        <div id="showmsg2" style="display: none"></div>
                    </form>
                    <h3>Un compte? Connectez-vous <a id = 'ici' href="$connexion">ici</a> !</h3>
               </div> 		
            </div>
        <script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlConnexion(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/connexion.js";
        $validerConnexion = $this->htmlvars['validerConnexion'];
        $inscription = $this->htmlvars['inscription'];
        $token = md5(uniqid(mt_rand(), true));
        $_SESSION['token'] = $token;
        return <<<END
			<div class="entete4">
                <div id="login">
                    <h1>Connexion</h1>
                    <form method="POST" action="$validerConnexion" id="formvalider">
                        <input type="text" required="required" placeholder="Identifiant" name="user" id="user" >
                        <div class="div-bor">
                            <input type="password" required="required" placeholder="Mot de passe" name="password" id="password" >
                            <i class="icon-user3" id="icon-user3"></i>
                        </div>
                        <input type="hidden" name="token" id="token" value="$token">
                        <button class="but" type="submit">Connexion</button>
                    </form>
                    <h3>Pas de compte? Inscrivez-vous <a id = 'ici' href="$inscription">ici</a> !</h3>
                </div>     		
            </div>
        <script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlAccueil(){
        return <<< END
		<div class="entete">
			<h1><div class = "contenu">
				<div class="container3 d-flex align-items-center flex-column">
                    <div class="container3 d-flex align-items-center flex-column">
                        <h1 class="masthead-heading text-uppercase mb-0">Welcome to myAppCrise</h1>
                        <div class="divider-custom divider-light">
                            <div class="divider-custom-line"></div>
                            <div class="divider-custom-icon">Créé par Ziyi</div>
                            <div class="divider-custom-line"></div>
                        </div>
                        <p class="masthead-subheading font-weight-light mb-0">Offrez-vous le Premium! <br>Profiter de l'essai gratuit</p>
                    </div>
				</div>
		    </div></h1>
        </div>
END;
    }


    public function htmlCompte(){
        $modifMotDePasse = $this->htmlvars['modifMotDePasse'];
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/compte.js";
        $affichageProfil = $this->AfficherIden();
        return <<< END
			<div class="entete">
				<div class="monCompte">
				    <div id="profil">
                        <div class="c1" id="c1">
                             <div id="prompt3">
                                <span id="imgSpan" style="left: 0; right: 0 ">Upload image</span>
                                <input type="file" id="file" class="filepath" onchange="uploadPhoto(this)" accept="image/jpg,image/jpeg,image/png,image/PNG">
                             </div>
                             <img id="img3" alt="portrait"/>        
                        </div>
                        $affichageProfil
                    </div>
                    <div id="login">
                        <h2>Changer le mot de passe</h2>
                        <form method="post" action="$modifMotDePasse" id="formvalider">
                            <div class="div-bor">
                                <input type="password" name="amdp" id="amdp" placeholder="Ancien mot de passe" required><br>
                                <i class="icon-user4" id="icon-user4"></i>
                            </div>
                            <div class="div-bor">
                                <input type="password" name="mdp" id="mdp" placeholder="Nouveau mot de passe" required><br>
                                <i class="icon-user5" id="icon-user5"></i>
                            </div>
                            <button type="submit" class="but" id="submit">Modifier</button>
                        </form> 
                    </div>                     
                </div>	
            </div>
        <script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function render($s, $h){
        $this->selecteur = $s;
        $this->htmlvars = $h;
        $liencss = $this->htmlvars['basepath']."/public/web/css/style.css";
        $accueil = $this->htmlvars['accueil'];
        $connexion = $this->htmlvars['connexion'];
        $inscription = $this->htmlvars['inscription'];
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
		<title>myAppCrise</title>
	</head>
	<body>
		<header>
			<div class="alignement">
				<div class="logo"></div>
				<div class="container">
					<div class="d"><a href=$accueil>Accueil</a></div>
					<div class="d"><a href=$connexion>myAppCrise</a></div>
					<hr>
					<div class="d"><a href=$connexion>Connexion</a></div>
					<div class="d"><a href="$inscription">Inscription</a></div>
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


    public function renderConnecte($s, $h) {
        $this->selecteur = $s;
        $this->htmlvars = $h;
        $filtrer = $this->htmlvars['filtrer'];
        $accueil = $this->htmlvars['accueil'];
        $liencss = $this->htmlvars['basepath']."/public/web/css/style.css";
        $img = $this->htmlvars['basepath'].'/public/web/images/tirer.png';
        $liencss3 = $this->htmlvars['basepath']."/public/web/css/messagerie.css";
        $liste = $this->VerifAdmi();
        $myAppCrise = $this->myAppCrise();

        switch ($this->selecteur) {

            case self::COMPTE_VIEW: {
                $content = $this->htmlCompte();
                break;
            }

            case self::ACCUEIL_VIEW: {
                $content = $this->htmlAccueil();
                break;
            }

            case self::InfoContaminee_VIEW: {
                $content = $this->htmlContaminee();
                break;
            }

            case self::Filtrer_VIEW: {
                $content = $this->htmlFiltrer();
                break;
            }

            case self::MESSAGERIE_VIEW: {
                $content = $this->htmlMessagerie();
                break;
            }
        }

        $html = <<<END
        <!DOCTYPE html>
        <html lang=fr>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href=$liencss>
                <link rel="stylesheet" href=$liencss3>
                <title>myAppCrise</title>
            </head>
            <body>
                <header>
                    <div class="alignement">
                        <div class="logo"></div>
                        <div class="container">
                            <div class="d"><a href=$accueil>Accueil</a></div>
                            <div class="d">
                                <li class="drop-down">
                                <a href=$filtrer>myAppCrise</a>
                                    <ul class="drop-down-content">
                                        $myAppCrise
                                    </ul>
                                </div>
                            <hr>
                            <div class="d">
                                <li class="drop-down">
                                    <a href="#">Profil <img src=$img alt="tirer.png"></a> 
                                    <ul class="drop-down-content">
                                        $liste
                                    </ul>
                                </li>
                            </div>
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
        return $html;
    }


}