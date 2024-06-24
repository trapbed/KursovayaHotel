<?php

$id_book = isset($_GET['id_book']) && $_GET['id_book'] != "" ? $_GET['id_book'] : false;
$dateD = isset($_GET['dateD']) && $_GET['dateD'] != "" ? $_GET['dateD'] : false;
$dateA = isset($_GET['dateA']) && $_GET['dateA'] != "" ? $_GET['dateA'] : false;
$room = isset($_GET['room']) && $_GET['room'] != "" ? $_GET['room'] : false;

if($id_book){
    echo "
    <script>
        let ask = confirm('Вы точно хотите отменить бронь?');
        if(ask){
            location.href='book_delete.php?id=".$id_book."&dateA=$dateA&dateD=$dateD&room=$room';
        }
        else{
            alert('Номер еще забронирован на ваше имя!');
            location.href='../account.php?page=history';
        }
    </script>";
}
else{
    $_SESSION['message'] = '';
}

if($check == true){
    echo "fdfjdhfhdj";
}
?>