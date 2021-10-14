<?php

require_once '../../index.php';
use crise\models\Group;
use crise\models\Board;

$nomGroup = $_GET['nomGroup'];
$group = new Group;
$group->nomGroup = $nomGroup;
$group->save();


$board = new Board;
$board->idGroup = $group->idGroup;
$board->save();
