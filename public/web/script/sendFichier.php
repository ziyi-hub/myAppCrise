<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Messages;

$blob = $_POST["blob"];
$idUtilisateur = $_POST["id"];

$messages = new Messages;
$messages->content = $blob;
$messages->save();

$contact = new Contact;
$contact->nomContact = $_SESSION['profile']['username'];
$contact->individuel = $idUtilisateur;
$contact->idUtilisateur = $_SESSION['profile']['id'];
$contact->idMessage = $messages->idMessage;
$contact->save();

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