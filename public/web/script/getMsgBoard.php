<?php

require_once '../../index.php';
use crise\models\Board;

$board = Board::query()
    ->where("contentBoard", "!=", null)
    ->where("idGroup", "=", 1)
    ->get();

echo $board;