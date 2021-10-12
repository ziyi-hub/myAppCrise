<?php

require_once '../../index.php';
use crise\models\Group;

$nomGroup = $_GET['nomGroup'];
$group = new Group;
$group->nomGroup = $nomGroup;
$group->save();
