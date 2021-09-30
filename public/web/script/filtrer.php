<?php

require __DIR__ . '/../../../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as DB;
session_start();
use crise\models\Utilisateurs;

$html = null;
$db = new DB();
$db->addConnection(
    [
        'host' => 'localhost',
        'con_db_port' => '3306',
        'username' => 'PWeb',
        'password' => '1Zhongguo',
        'database' => 'PWeb',
        'charset' => 'utf8',
        'driver' => 'mysql'
    ]);
$db->setAsGlobal();
$db->bootEloquent();
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