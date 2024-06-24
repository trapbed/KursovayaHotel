<?php
session_start();
require "../database/User.php";
if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['bday'])){
    if(ctype_space($_POST['email']) == false && ctype_space($_POST['pass']) == false){
        $user = new User();
        $user = $user->signup($_POST['email'],$_POST['bday'],$_POST['pass'] );
    }
    else{
        $_SESSION['message'] = "Заполните все поля!";
        header("Location: ../");
    }   
}
else{
    $_SESSION['message'] = "Заполните все поля!";
    header("Location: ../");
}
?>