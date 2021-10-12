<?php

session_start();

if (!is_null($_SESSION['profile'])) {
    echo $_SESSION['profile']['username'];
}