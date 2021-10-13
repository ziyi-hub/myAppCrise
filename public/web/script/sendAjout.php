<?php

require_once '../../index.php';
use crise\models\Utilisateurs;
use crise\models\Contact;

$idUtilisateur = $_GET['idUtilisateur'];
$user = Utilisateurs::find($idUtilisateur);
$user->ami = "oui";
$user->save();

$contact = new Contact;
$contact->nomContact = $user->nomUtilisateur;
$contact->idUtilisateur = $idUtilisateur;
$contact->idGroupContact = -1;
$contact->save();

$res = Contact::join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("idGroupContact", "=", "-1")
    ->get();

echo $res;