<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Utilisateurs;
use crise\models\Messages;

$idUtilisateur = $_GET['idUtilisateur'];
$idGroup = $_GET["idGroup"];
$nomContact = Utilisateurs::query()->where("idUtilisateur", "=", $idUtilisateur)->get(["nomUtilisateur"]);
$contact = new Contact;
//$contact->belongsToMany(new Messages, );
$contact->nomContact = $nomContact[0]["nomUtilisateur"];
$contact->idUtilisateur = $idUtilisateur;
$contact->idGroupContact = $idGroup;
$contact->save();

echo Contact::all();
