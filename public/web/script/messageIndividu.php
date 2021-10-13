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

/*
$nomContact = Utilisateurs::query()->where("idUtilisateur", "=", $idUtilisateur)->get(["nomUtilisateur"]);
$contact = new Contact;
$contact->nomContact = $nomContact[0]["nomUtilisateur"];
$contact->individuel = "oui";
$contact->idUtilisateur = $idUtilisateur;
$contact->idMessage = $messages->idMessage;
$contact->save();
*/


