<?php

require "../database/User.php";

$user = new User();
$user = $user->signup($_POST['login'],$_POST['bday'],$_POST['email'],$_POST['pass'] );

// echo "<br>";
// print_r($user);
?>