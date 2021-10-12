<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Messages;

$message = $_GET['message'];
/*
$messages = new Messages;
$messages->content = $message;
$message->tempsEnvoi = date('Y-m-d H:i');
$messages->save();

$contact = new Contact;
//$contact->idGroupContact = 1;
if (!is_null($_SESSION['profile'])) {
    $contact->nomContact = $_SESSION['profile']['username'];
    $contact->idUtilisateur = $_SESSION['profile']['id'];
}
*/
