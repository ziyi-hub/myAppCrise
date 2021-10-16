<?php

require_once '../../index.php';
use crise\models\Group;
use crise\models\Board;

$content = $_GET['content'];
$board = new Board;
$board->idGroup = 1;
//$board = Board::query()->where("idGroup", "=", 1)->firstOr();
$board->idUtilisateur = $_SESSION['profile']['id'];
$board->contentBoard = $content;
$board->save();

echo $content;

