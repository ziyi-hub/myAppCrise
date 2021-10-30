<?php

require_once '../../index.php';
use crise\models\Contact;


$idUtilisateur = $_GET['idUser'];

$msgMien = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->where("idUtilisateur", "=", $_SESSION['profile']['id'])
    ->where("individuel", "=", $idUtilisateur)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

$msgSien = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->where("idUtilisateur", "=", $idUtilisateur)
    ->where("individuel", "=", $_SESSION['profile']['id'])
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $msgSien->merge($msgMien);