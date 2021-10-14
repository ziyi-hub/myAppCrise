<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Messages;
use crise\models\Utilisateurs;

$message = $_GET['message'];
$idUtilisateur = $_GET['idUtilisateur'];

$messages = new Messages;
$messages->content = $message;
$messages->save();

$contact = new Contact;
$contact->nomContact = $_SESSION['profile']['username'];
$contact->individuel = $idUtilisateur;
$contact->idUtilisateur = $_SESSION['profile']['id'];
$contact->idMessage = $messages->idMessage;
$contact->save();

$contact = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("idGroupContact", "=", null)
    ->where("Contact.idUtilisateur", "=", $idUtilisateur)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

$moi = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("idGroupContact", "=", null)
    ->where("Contact.idUtilisateur", "=", $_SESSION['profile']['id'])
    ->where("individuel", "=", $idUtilisateur)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $contact->merge($moi);


