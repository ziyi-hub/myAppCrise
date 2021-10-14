<?php

require_once '../../index.php';
use crise\models\Contact;


$res = Contact::join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("individuel", "=", $_SESSION['profile']['id'])
    ->get();

echo $res;