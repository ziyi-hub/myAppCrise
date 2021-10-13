<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Messages;

$message = $_GET['message'];
$idGroup = $_GET['idGroup'];


$messages = new Messages;
$messages->content = $message;
$messages->save();

$contact = new Contact;
$contact->idGroupContact = $idGroup;
if (!is_null($_SESSION['profile'])) {
    $contact->nomContact = $_SESSION['profile']['username'];
    $contact->idUtilisateur = $_SESSION['profile']['id'];
}
$contact->idMessage = $messages->idMessage;
$contact->save();

$res = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->where("idGroupContact", "=", $idGroup)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $res;
