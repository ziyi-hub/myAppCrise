<?php

require_once '../../index.php';
use crise\models\Contact;

$id = $_GET['idUser'];

$res = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("idGroupContact", "=", "-1")
    ->where("Contact.idUtilisateur", "=", $id)
    ->get();

echo $res;
