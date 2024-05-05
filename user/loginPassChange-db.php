<?php

session_start();
include "../database/User.php";

$user = new User();
$user = $user->changeLoginPass($_SESSION['id_user'], $_POST['login'], $_POST['pass']);

?>