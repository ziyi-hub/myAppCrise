<?php

require_once '../../index.php';
use crise\models\Contact;

$idGroup = $_GET['idGroup'];
$messages = Contact::join('messages','messages.idMessage','=','contact.idMessage')
    ->where("idGroupContact", "=", $idGroup)
    ->orderBy('tempsEnvoi','ASC')
    ->get();

echo $messages;