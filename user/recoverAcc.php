<?php

require_once "../database/User.php";
session_start();

$email = isset($_POST['email']) && $_POST['email']  != ""  ? $_POST['email'] : false ;

if($email == false){
    $_SESSION['message'] = "Заполните все поля!";
    echo "<script>
        location.href = '../user/recoverAcc.php';
    </script>";
}

$array = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', 
'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z', 0, 1, 2,3, 4, 5, 6, 7, 8, 9 ];

$random = array_rand($array, 8);
$new_pass = '';

foreach($random as $r){
     $new_pass.=$array[$r];
}

if($email){
    //  $check = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
     $check = new User();
     $check = $check->user_exist_email($email);
     print_r($check);
     if($check){
        echo "ddvjdfk";
          if(mail("$email","Обновленый пароль","Ваш новый пароль для доступа на сайте по бронированию номеров LION : $new_pass")){
               $_SESSION['message'] = "Письмо отправлено на вашу почту $email";
               $query = new User();
               $query = $query->recoverAcc($email, $new_pass);
            //    $query = mysqli_query($conn, "UPDATE `users` SET `password` = '$new_pass' WHERE `users`.`email` = '$email';");
          }
          else{
               $_SESSION['message'] = "Не удалось отправить письмо";
          }
     }
     else{
        echo "lll";
          $_SESSION['message'] = "Такого пользователя не существует!";
     }
     header("Location: ../index.php");

}
else{
     $_SESSION['message'] = "Заполните все поля";
}

?>
<!-- При покупке на почту отправить чек со списком купленных товаров  -->