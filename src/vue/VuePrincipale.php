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
    const Filtrer_VIEW = 7;
    const MESSAGERIE_VIEW = 8;
    const LOCAL_VIEW = 9;

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
            $monCompte = $this->htmlvars['monCompte'];
            $deconnexion = $this->htmlvars['deconnexion'];
            $html = <<<END
<li><div id="triangle"></div></li>
<li><a href=$monCompte>Mon Compte</a></li>
<li><a href=$deconnexion>Déconnexion</a></li>
END;
        }
        return $html;
    }


    private function myAppCrise() {
        $html = null;
        if (!empty($_SESSION["profile"])){
            $filtrer = $this->htmlvars['filtrer'];
            $groupe = $this->htmlvars['groupe'];
            $localisation = $this->htmlvars['localisation'];
            $html = <<<END
<li><div id="triangle"></div></li>
<li><a href=$filtrer>Messagerie</a></li>
<li><a href=$groupe>Groupe</a></li>
<li><a href=$localisation>Localisation</a></li>
END;
        }
        return $html;
    }

    public function htmlMessagerie(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/messagerie.js";
        $img_icon_png = $this->htmlvars['basepath']."/public/web/images/icon_png.png";
        $img_Pdf = $this->htmlvars['basepath']."/public/web/images/AdobePdf.png";
        $img_Word = $this->htmlvars['basepath']."/public/web/images/Word.png";
        $img_Excel = $this->htmlvars['basepath']."/public/web/images/Excel.png";
        $img_icon_info = $this->htmlvars['basepath']."/public/web/images/icon_info@2x.png";
        return <<< END
<div class="entete">
<div class="filtrer2">
<div class="menu"></div>
<div class="contain">
    <div class="left">
        <div class="top">
            <div class="top-nombre">nombre total : <span id="numbers">0</span>
                <button type='submit' id='nouGroup2'>Inviter un ami</button>
            </div>
        </div>
        <ul class="people"></ul>
    </div>
    <div class="right">
        <div class="top" style="padding-top: 0 !important; padding-bottom: 0 !important;">
            <span style="padding: 15px 30px;">Tips: <span class="nameGroup">myAppCrise--group</span></span>
            <span><button id="btn-board" style="width: 50%; border-radius: unset; height: 100%; margin: 0">Board</button></span>
        </div>
        <div class="chat active-chat" data-chat="person1" style="border-width: 0; padding: 10px; height: 483px; padding: 10px; overflow-y: auto; scrollTop: 100px"></div>
        <div class="write">
            <input type="file" id="file" class="write-link attach" onchange="upload(this)" accept="image/jpg,image/jpeg,image/png,image/PNG,audio/*" style="z-index: 99; width: 500px;">
            <input type="text" id="input-value" style="position: absolute; z-index: 100; left: 35px !important; width: 450px !important;"/>
            <a class="write-link smiley"></a>
            <a class="write-link send"></a>
        </div>
    </div>
    <div id="lightbox">
        <span class="close">X</span>
        <h2 style="color: unset; text-shadow: unset">Création un groupe</h2>
        <input type="text" id="nom-group" placeholder="Nom d'un group"/>
        <button id="btn-group">Envoyer</button>
    </div>
    <div id="recheAmi">
        <span class="close2">X</span>
        <h2 style="color: unset; text-shadow: unset">Inviter un ami</h2>
        <input type="text" id="key" placeholder="Ex: Ziyi-38"/>
        <input type="text" id="key-idGroup" placeholder="Ex: group1"/>
        <button id="btn-integAmi">Envoyer</button>
        <div id="showmsg" style="box-sizing: border-box;"></div>
    </div>
    <div id="board" style="position: relative; z-index: 101;">
        <span class="close3">X</span>
        <div class="d-upload-box" style="margin-top: 50px">
            <div class="d-title"></div>
            <!-- partie non uploader -->
            <div class="d-upload" onclick="clickUpLoad('upload-new')">
                <input type="file" id="upload-new" class="upload-new" accept="*"
                       onchange="uploadFile('upload-new')">
                <span class="icon-upload"></span>&nbsp;
                <span style="color:#325ce1;">
                    Cliquez pour uploader (*.docx, *.xlsx)
                </span>
            </div>
            <!-- Partie déjà uploader -->
            <div class="d-already-upload">
                <div class="d-tips"><img src=$img_icon_info>Actualisez la page pour voir</div>
                <div class="d-file">
                    <div class="left-board">
                        <img class="img-png" src=$img_icon_png>
                        <img class="img-pdf" src=$img_Pdf>
                        <img class="img-word" src=$img_Word>
                        <img class="img-excel" src=$img_Excel>
                        <span class="s-file-name"></span>
                        <span class="right-board s-file-size"></span>
                    </div>
                    <div class="right-board">
                        <span id="progress" >Téléchargement</span>
                        <span class="s-text"><i class="icon icon-success"></i>Succès</span>
                        <i class="icon icon-del" title="supprimer" onclick="openModal()"></i>
                    </div>
                </div>
            </div>
        
            <!-- supression fenêtre -->
            <div class="d-modal">
                <div class="d-modal-content">
                    <div class="d-modal-head">
                        <div class="d-modal-head-left">fenêtre</div>
                        <div class="d-modal-head-right" onclick="closeModal()"></div>
                    </div>
                    <div class="d-modal-body">
                        <div class="d-modal-body-left"></div>
                        <div class="d-modal-body-right">
                            <div class="d-modal-body-title">Etes-vous sûr le supprimer？</div>
                            <div>
                                <div class="d-btn" onclick="deleteFile()">Oui</div>
                                <div class="d-btn" onclick="closeModal()">Annuler</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div id="affichage-board"></div>       
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlFiltrer(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/filtrer.js";
        return <<< END
<div class="entete">
    <div class="filtrer3">
        <div class="contain">
            <div class="left">
                    <div class="top" style="padding: 20px 29px; height: auto;">
                        <div class="" style="font: 13px Arial; ">
                            <button type='submit' id='nouGroup2'>Ajouter un ami</button>
                        </div>
                    </div>
                    <ul class="people"></ul>
            </div>
            <div class="right">
                <div class="top"><span>Tips: <span class="">Message individuel</span></span></div>
                <div class="chat active-chat" data-chat="person1"
                         style="box-sizing: border-box; border-width: 0; padding: 10px; height: 483px; overflow-y: auto;">
                </div>
                <div class="write">
                    <input type="file" id="file" class="write-link attach" onchange="upload(this)" accept="image/jpg,image/jpeg,image/png,image/PNG,audio/*" style="z-index: 99; width: 600px;">
                    <input type="text" id="input-value" style="position: absolute; z-index: 100; left: 35px !important; width: 550px !important;"/>
                    <a class="write-link smiley"></a>
                    <a class="write-link send"></a>
                </div>
            </div>
            <div id="recheAmi">
                <span class="close2">X</span>
                <h2 style="color: unset; text-shadow: unset">Rechercher/Ajouter un ami</h2>
                <input type="text" id="keywords" placeholder="Ex: Ziyi-38" style="width: 77%;"/>
                <button id="btn-integAmi">Envoyer</button>
                <div id="showmsg" style="box-sizing: border-box;"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlLocal(){
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/localisation.js";
        return <<< END
        <div class="entete">
            <div id="googleMap"></div>
        </div>
        <input type="text" id="rayon" placeholder="Ex: 0 ~ 5 (km)" required>
        <button type="submit" id="btn-rayon">ok</button>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCfld0seEmoVxj0ZRr7AAT_206D96d2QU"></script>
        <script type="text/javascript" src=$lienjs defer></script>
END;
    }


    public function htmlInscription(){
        $name = $_SESSION['token_ins']['name'];
        $value = $_SESSION['token_ins']['value'];
        $nameKey = $_SESSION['token_ins']['nameKey'];
        $valueKey = $_SESSION['token_ins']['valueKey'];
        $erreur = $_SESSION['erreur']['inscription'];
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
                        <div class="radio">
                            contaminé(e)<input type="radio" id="statut" name="statut" value="oui" style="width: 40px;">
                            non contaminé(e)<input type="radio" id="statut" name="statut" value="non" style="width: 40px;">
                        </div>
                        <input type="hidden" name="$nameKey" value="$name">
                        <input type="hidden" name="$valueKey" value="$value">
                        <button type="submit" class="but" id="submit">Inscription</button>
                        <div id="showmsg2"></div>
                        <div id="erreur-inscription">$erreur</div>
                    </form>
                    <h3>Un compte? Connectez-vous <a id = 'ici' href="$connexion">ici</a> !</h3>
               </div> 		
            </div>
        <script type="text/javascript" src="$lienjs" defer></script>
END;
    }


    public function htmlConnexion(){
        $name = $_SESSION['token_con']['name'];
        $value = $_SESSION['token_con']['value'];
        $nameKey = $_SESSION['token_con']['nameKey'];
        $valueKey = $_SESSION['token_con']['valueKey'];

        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/connexion.js";
        $validerConnexion = $this->htmlvars['validerConnexion'];
        $inscription = $this->htmlvars['inscription'];
        $erreur = $_SESSION['erreur']['connexion'];
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
                        <input type="hidden" name="$nameKey" value="$name">
                        <input type="hidden" name="$valueKey" value="$value">
                        <button class="but" type="submit">Connexion</button>
                        <div id="erreur-connexion">$erreur</div>
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
                            <div class="divider-custom-icon">Réalisé par Ziyi</div>
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
        $name = $_SESSION['token_modif']['name'];
        $value = $_SESSION['token_modif']['value'];
        $nameKey = $_SESSION['token_modif']['nameKey'];
        $valueKey = $_SESSION['token_modif']['valueKey'];
        $modifMotDePasse = $this->htmlvars['modifMotDePasse'];
        $lienjs = $this->htmlvars['basepath']."/public/web/javascript/compte.js";
        $erreur = $_SESSION['erreur']['modification'];
        $affichageProfil = $this->AfficherIden();
        return <<< END
			<div class="entete">
				<div class="monCompte">
				    <div id="profil">
                        <div class="c1" id="c1">
                             <div id="prompt3">
                                <span id="imgSpan" style="left: 0; right: 0 "></span>
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
                            <input type="hidden" name="$nameKey" value="$name">
                            <input type="hidden" name="$valueKey" value="$value">
                            <button type="submit" class="but" id="submit">Modifier</button>
                            <div id="erreur-modification">$erreur</div>
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
        $liencss2 = $this->htmlvars['basepath']."/public/web/css/reset.css";
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

            case self::Filtrer_VIEW: {
                $content = $this->htmlFiltrer();
                break;
            }

            case self::MESSAGERIE_VIEW: {
                $content = $this->htmlMessagerie();
                break;
            }

            case self::LOCAL_VIEW: {
                $content = $this->htmlLocal();
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
                <link rel="stylesheet" href=$liencss2>
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