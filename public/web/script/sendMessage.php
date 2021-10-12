<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Messages;

$message = $_GET['message'];
echo $message;

$messages = new Messages;
$messages->content = $message;
$messages->save();

$contact = new Contact;
$contact->belongsToMany($contact, "messages", "idMessage", "idContact")
    ->where("Messages.idMessage", "=", "Contact.idMessage");
$contact->idGroupContact = 1;
if (!is_null($_SESSION['profile'])) {
    $contact->nomContact = $_SESSION['profile']['username'];
    $contact->idUtilisateur = $_SESSION['profile']['id'];
}
$contact->save();



