<?php

require_once '../../index.php';
use crise\models\Localisations;

echo Localisations::query()->where("rayon", "<", $_GET["rayon"])->get();
