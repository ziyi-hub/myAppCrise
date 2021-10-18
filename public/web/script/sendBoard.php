<?php

require_once '../../index.php';
use crise\models\Group;
use crise\models\Board;

$filename = $_FILES["file"]["name"];
$blob = $_POST["api"];
$idgroup = $_POST["idgroup"];
//echo $blob;

$board = new Board;
$board->idGroup = $idgroup;
$board->fileName = $filename;
$board->idUtilisateur = $_SESSION['profile']['id'];
$board->contentBoard = $blob;
$board->save();


