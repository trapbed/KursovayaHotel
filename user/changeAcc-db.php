<?php

require "../database/User.php";

$user = new User();
$user = $user->add_info($_SESSION['id_user'], $_POST['name'], $_POST['sname'], $_POST['path'], $_POST['bday'], $_POST['phone'], $_POST['email']);

// print_r($user);
?>