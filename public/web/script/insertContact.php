<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Utilisateurs;
use crise\models\Messages;
use crise\models\Group;

$idUtilisateur = $_GET['idUtilisateur'];
$nomGroup = $_GET["nomGroup"];
$Group = Group::query()->where("nomGroup", "=", $nomGroup)->first();
$nomContact = Utilisateurs::query()->where("idUtilisateur", "=", $idUtilisateur)->get(["nomUtilisateur"]);
$contact = new Contact;
$message = new Messages;
$contact->nomContact = $nomContact[0]["nomUtilisateur"];
$contact->idUtilisateur = $idUtilisateur;
$contact->idGroupContact = $Group["idGroup"];
$message->content = "";
$message->save();
$contact->idMessage = $message->idMessage;
$contact->save();

