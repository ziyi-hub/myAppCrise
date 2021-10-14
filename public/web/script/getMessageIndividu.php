<?php

require_once '../../index.php';
use crise\models\Contact;

//$id = $_GET['idUser'];

$res = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->join("Utilisateurs", "Utilisateurs.idUtilisateur", "=", "Contact.idUtilisateur")
    ->where("ami", "=", "oui")
    ->where("Contact.idGroupContact", "=", "29")
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $res;
