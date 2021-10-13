<?php

require_once '../../index.php';
use crise\models\Contact;


$res = Contact::join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("idGroupContact", "=", "-1")
    ->get();

echo $res;