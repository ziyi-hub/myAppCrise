<?php

require_once '../../index.php';
use crise\models\Group;
use crise\models\Board;

$idgroup = $_GET['idgroup'];
$content = $_GET['content'];
$board = new Board;
$board->idGroup = $idgroup;
$board->idUtilisateur = $_SESSION['profile']['id'];
$board->contentBoard = $content;
$board->save();

echo $content;

