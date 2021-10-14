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
$contact->individuel = $_SESSION['profile']['id'];
$contact->save();

$res = Contact::join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->select("Contact.idUtilisateur", "nomContact")
    ->distinct()
    ->where("ami", "=", "oui")
    ->where("individuel", "=", $_SESSION['profile']['id'])
    ->get();

echo $res;