<?php

require_once '../../index.php';
use crise\models\Contact;

$idGroup = $_GET['idGroup'];
$messages = Contact::join('Messages','Messages.idMessage','=','Contact.idMessage')
    ->where("idGroupContact", "=", $idGroup)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $messages;