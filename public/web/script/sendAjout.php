<?php

require_once '../../index.php';
use crise\models\Utilisateurs;

$idUtilisateur = $_GET['idUtilisateur'];
echo $idUtilisateur;
$user = Utilisateurs::find($idUtilisateur);
$user->ami = "oui";
$user->save();