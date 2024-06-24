<?php

session_start();
include "../database/User.php";

$login = isset($_POST["email"])  ? $_POST["email"] : false;
$pass = isset($_POST["pass"])  ? $_POST["pass"] : false;
if($login && $pass) {
    if(ctype_space($_POST['email']) == false && ctype_space($_POST['pass']) == false ){
        $user = new User();
        $user = $user->changeLoginPass($_SESSION['id_user'], $_POST['email'], $_POST['pass']);
    }
    else{
        $_SESSION['message'] = "Заполните все поля!";
        header("Location: ../loginPassChange.php");
    }
}
else{
    $_SESSION['message'] = "Заполните все поля!";
    header("Location: ../loginPassChange.php");
}

?>