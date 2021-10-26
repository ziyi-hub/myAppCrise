<?php

require_once '../../index.php';
use crise\models\Profil;

$profil = Profil::query()
    ->join("Localisations", "Localisations.idProfil", "=", "Profil.idProfil")
    ->where("statutContamine", "=", "oui")
    ->where("rayon", "<", $_GET["rayon"])
    ->get();

echo $profil;
