<?php

require_once '../../index.php';
use crise\models\Group;


$html = null;
$groups = Group::query()->get();
foreach ($groups as $group){
    $nomGroup = $group->nomGroup;
    $idGroup = $group->idGroup;
    $html .=
        "<div class='exbtn' data-idGroup=$idGroup data-nomGroup=$nomGroup>$nomGroup</div>";
}
echo $html;