<?php

require_once '../../index.php';
use crise\models\Contact;

$id = $_GET['idUser'];

$res = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("individuel", "=", "oui")
    ->where("idGroupContact", "=", "29")
    ->where("Contact.idUtilisateur", "=", $id)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $res;
