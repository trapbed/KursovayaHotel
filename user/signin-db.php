<?php

require "../database/User.php";

$user = new User();

$user = $user->signin($_POST['login'], $_POST['pass']);

// print_r($user);
?>