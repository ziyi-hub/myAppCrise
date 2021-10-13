<?php

require_once '../../index.php';
use crise\models\Contact;


$res = Contact::join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("individuel", "=", "oui")
    ->get();

echo $res;