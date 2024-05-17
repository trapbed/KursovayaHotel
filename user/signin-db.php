<?php

require "../database/User.php";

$user = new User();

$user = $user->signin($_POST['pass'], $_POST['email']);

// print_r($user);
?>