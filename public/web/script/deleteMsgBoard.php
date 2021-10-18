<?php

require_once '../../index.php';
use crise\models\Board;

$idBoard = $_GET["idBoard"];
$board = Board::query()->where('idBoard', '=', $idBoard)->first();
$board->delete();