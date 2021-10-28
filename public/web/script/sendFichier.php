<?php

require_once '../../index.php';
use crise\models\Contact;
use crise\models\Messages;

$blob = $_POST["blob"];
$idUtilisateur = $_POST["id"];
echo $blob;
/*
$messages = new Messages;
$messages->content = $blob;
$messages->save();

$contact = new Contact;
$contact->nomContact = $_SESSION['profile']['username'];
$contact->individuel = $idUtilisateur;
$contact->idUtilisateur = $_SESSION['profile']['id'];
$contact->idMessage = $messages->idMessage;
$contact->save();
*/