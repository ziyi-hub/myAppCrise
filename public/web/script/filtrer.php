<?php

require_once '../../index.php';
use crise\models\Utilisateurs;

$html = null;
$users = Utilisateurs::query()->where('nomUtilisateur', 'LIKE',$_GET["NomUtilisateur"].'%')->get();
foreach ($users as $donnees){
    $id = $donnees->idUtilisateur;
    $nom = $donnees->nomUtilisateur;
    $html .=
"<div id='chercher-user' data-id='$id' data-nom='$nom'>
            <strong>#N° : $id </strong>
            <strong>$nom</strong>
</div>";
}
echo $html;