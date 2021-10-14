<?php

require_once '../../index.php';
use crise\models\Utilisateurs;
use crise\models\Contact;
use crise\models\Group;

$idUtilisateur = $_GET['idUtilisateur'];
$user = Utilisateurs::find($idUtilisateur);
$user->ami = "oui";
$user->save();

$group = new Group;
$group->nomGroup = "";
$group->save();

$contact = new Contact;
$contact->nomContact = $user->nomUtilisateur;
$contact->idUtilisateur = $idUtilisateur;
$contact->idGroupContact = $group->idGroup;
$contact->individuel = $_SESSION['profile']['id'];
$contact->save();

$res = Contact::join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("individuel", "=", $_SESSION['profile']['id'])
    ->get();

echo $res;