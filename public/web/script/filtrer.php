<?php

require_once '../../index.php';
use crise\models\Utilisateurs;

$html = null;
$users = Utilisateurs::query()->where('nomUtilisateur', 'LIKE',$_GET["NomUtilisateur"].'%')->get();
foreach ($users as $donnees){
    $id = $donnees->idUtilisateur;
    $nom = $donnees->nomUtilisateur;
    $html .=
"<div id='chercher-user'>
            <strong>PROFIL #N°</strong> : $id<br />$nom<br /><em>
</div>";
}
echo $html;