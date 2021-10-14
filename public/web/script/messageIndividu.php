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
$contact->idGroupContact = 29;
$contact->save();


