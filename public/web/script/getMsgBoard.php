<?php

require_once '../../index.php';
use crise\models\Board;

$idGroup = $_GET["idgroup"];
$board = Board::query()
    ->where("contentBoard", "!=", null)
    ->where("idGroup", "=", $idGroup)
    ->get();

echo $board;