<?php
session_start();
require "../database/User.php";

$user = new User();
$user = $user->signup($_POST['email'],$_POST['bday'],$_POST['pass'] );

// function signup($login, $bday, $email, $pass){
//     if($login, $bday, $email, $pass){
//         $check_user = mysqli_query($this->c);
//     }
//     else{
//         $_SESSION['mess'] = "Заполните все поля!";
//     }
// }
// echo "<br>";
// print_r($user);
?>