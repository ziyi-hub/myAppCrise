<?php

require_once '../../index.php';
use crise\models\Group;


$html = "<button type='submit' id='nouGroup' style='border-radius: unset; width: 100%'>Créer un group</button>";
$groups = Group::query()->get();
foreach ($groups as $group){
    $nomGroup = $group->nomGroup;
    $idGroup = $group->idGroup;
    $html .=
        "<div class='exbtn' data-idGroup=$idGroup data-nomGroup=$nomGroup>$nomGroup</div>";
}
echo $html;