<?php
require_once "../database/Booking.php";
// require_once "../database/User.php";
session_start();
// $_SESSION['check_visit'] += $_SESSION['check_visit'];

// if($_SESSION['check_visit'] != 2){
//     $_SESSION['message'] = "Подождите немного! Не кликайте по кнопке несколько раз пожалуйста";
//     echo "<script>
//         location.href = '../catalog.php';
//     </script>";
// }

$dateArrival = isset($_POST['dateArrival']) ? $_POST['dateArrival'] : false;
$dateDepart =  isset($_POST['dateDeparture']) ? $_POST['dateDeparture'] : false;
$idRoom = isset($_POST['idRoom']) ? $_POST['idRoom'] : false;
$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : false;

print_r($_POST);

if(!isset($dateArrival) || !isset($dateDepart ) || !isset($idRoom)||!isset($idUser)){
    $_SESSION['message'] = 'Что-то пошло не так, попробуйте снова!'; 
    header("Location: ../catalog.php");
}
else{
    // получаем массив мз дат которые есть в БД
    $exist_dates = new Book();
    $exist_dates = $exist_dates->get_exist_dates($dateArrival, $dateDepart);
    // echo "<br>";
// print_r($exist_dates);
    // echo $dateArrival, $dateDepart;

    // масссив из дат между заселением и выеселением 
    $array_between_dates = new Book();
    $array_between_dates = $array_between_dates->all_dates_between($dateArrival, $dateDepart);
    // print_r($array_between_dates);

    // массив из дат которых нет в забронированных номерах
    $difference = strtotime($dateDepart) - strtotime($dateArrival);
    // $difference = strtotime("$difference +1 day");
    $difference = $difference/60/60/24;

    // var_dump($difference);
    // var_dump($exist_dates['num_rows']);

    if($difference != $exist_dates['num_rows']){
        $non_exist_dates = new Book();
        $non_exist_dates = $non_exist_dates->crate_arr_non_exist_dates($dateArrival, $dateDepart, $exist_dates['array_dates'], $array_between_dates);
    }
    // print_r($difference);
    // print_r($exist_dates['num_rows']);
    // print_r($non_exist_dates);
    $sum_book = $_POST['sum_book'];

    // массив с номерами
    $array_rooms = new Book();
    $array_rooms = $array_rooms->get_array_book($idRoom);

    // заносим инфу
    $insert_book = new Book();
    $insert_book = $insert_book->insert_book($array_between_dates, $exist_dates['array_dates'], $non_exist_dates, $array_rooms, $idRoom);
    if($insert_book['result'] == true){
        $insert_into_book = new Book();
        $insert_into_book = $insert_into_book->insert_into_book($idUser, $idRoom, $dateArrival, $dateDepart, $insert_book['old_info']);
        if($insert_into_book == true){
            $name_room = new Book();
            $name_room = $name_room->get_name_room($idRoom);
            $email = new Book();
            $email = $email->get_email_user($idUser);
            print_r($email);
            if(mail("$email","Бронирование номера на сайте LION", "Номер: $name_room \n Дата заезда: $dateArrival, Дата выезда: $dateDepart \n Сумма брони: $sum_book")){
                $_SESSION['message'] = "Номер забронирован, отправили письмо на почту! Вся информация о брони находится в личном кабинете!";
                echo "<script>
                    location.href = '../catalog.php';
                </script>";
            }
            else{
                $_SESSION['message'] = "Номер забронирован, не удалось отправить письмо на почту! Вся информация о брони находится в личном кабинете!";
                echo "<script>
                    location.href = '../catalog.php';
                </script>";
            }
        }
    }
    else{
        $_SESSION['message'] = "Не удалось забронировать номер!";
        echo "<script>
            location.href = '../catalog.php';
        </script>";
    }

}
?>