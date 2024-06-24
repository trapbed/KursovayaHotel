<?php

require "../database/User.php";

$name = isset( $_POST["name"] )   ? $_POST["name"] :false;
$sname = isset($_POST['sname'])     ? $_POST['sname'] :false ;
$path = isset( $_POST['path'] )   ? $_POST['path'] :false ;
$bday = isset( $_POST['bday'] )   ? $_POST['bday'] :false ;
$phone = isset( $_POST['phone'] )  ? $_POST['phone'] :false ;

if($name && $sname && $path && $bday && $phone){
    if(ctype_space($_POST['name']) == false && ctype_space($_POST['sname']) == false && ctype_space($_POST['path']) == false && ctype_space($_POST['phone']) == false ){
        $user = new User();
        $user = $user->add_info($_SESSION['id_user'], $_POST['name'], $_POST['sname'], $_POST['path'], $_POST['bday'], $_POST['phone']);    
    }
    else{
        $_SESSION['message'] = "Заполните все поля!";
        header("Location: ../changeAcc.php?page=account");
    }
}
else{
    $_SESSION['message'] = "Заполните все поля!";
    header("Location: ../changeAcc.php?page=account");
}
// print_r($user);
?>