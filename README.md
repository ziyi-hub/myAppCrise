# CIASIE__LP2__WANG Ziyi

<h1>Utilisation d'application</h1>

<ol>
  <li>Lancez service docker</li>
  <li>Tapez la commande <code>docker-compose up --build</code> sur terminal</li>
  <li>
    Mettre en place le script de base de donnée ( webServeur/PWeb.sql )
    sur phpmyadmin <code>http://localhost:8002</code> avec des variables correspondant aux paramètres suivants :<br>
    <ul>Utilisateur: PWeb</ul>
    <ul>Mot de passe: 1Zhongguo</ul>
  </li>
  <li>Lancez l'application sur navigateur <code>http://localhost:8001</code></li>
</ol>

<h1>Introduction des fonctionnalités réalisées</h1>
<ol>
    <li>
        Dans l’interface d'inscription, j'ai ajouté certaines restrictions et vérifications lors de l'inscription pour éviter de s'inscrire avec un login déjà existant.
        Une fois inscription effectuée, vous vous connectez avec vos identifiants.
    </li>
    <li>Dans l’interface de Mon Compte, vous pouvez changer l’ancien mot de passe, uploader une l’image à partir d’un fichier local en cliquant un portrait.</li>
    <li>
        La fonctionnalité messages et groupes utilise AJAX, elle vous permet de rechercher d’autres utilisateurs et devenir amis. 
        Une fois amis, vous pouvez communiquer par messagerie privée. Chaque utilisateur pourra créer un groupe ou en intégrer un déjà existant. 
        Le système de messagerie s’adaptera pour fonctionner au travers des groupes. Des utilisateeurs peuvent partager des fichiers (type: images, audios).
    </li>
    <li>
        Les groupes disposent d’un panneau d’annonce permettant uploader afficher télécharger supprimer des fichiers (Tous types de fichiers). 
    </li>
    <li>
        Dans l’interface de localisation, je le réalisé en utilisant API Google Map, il permet de repérer les personnes contaminées dans un rayon donné (km).
    </li>
    <li>Une fois déconnexion effectuée, vous retournerez à l'interface de connexion et vous vous connectez avec vos identifiants.</li>
    <li>L'application utilise la sécurité CSRF (Cross-site request forgery). Le mot de passe de l'utilisateur est crypté dans la base de données.</li>
</ol>

<h1>Lien utiles:</h1>
<address>
    Toutes les images sont libres de droits d'auteur qui viennent
    <a href="https://unsplash.com">Unsplash</a> 
    et <a href="https://www.iconfont.cn">Iconfont</a>
    et <a href="https://console.cloud.google.com/google/maps-apis/api-list?project=dark-wharf-330118">Google Cloud Platform</a> 
</address>



