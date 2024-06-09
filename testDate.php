<?php
// require_once "../database/Admin_info.php";

    $date = date('2024-06-10');
    $con = mysqli_connect("localhost", "root", "", "lion");
    $book = mysqli_fetch_assoc(mysqli_query($con, "select book from occupied_rooms where date = '$date'"))['book'];

    $book = (array)json_decode($book);

    // ПРОВЕРЯЕМ ПОВТОРЯЮЩИЕСЯ И ПОЛУЧАЕМ КОЛИЧЕСТВО ОДИНАКОВЫХ
    $count = array_count_values($book);

    //ПЕРЕБИРАЕМ МАССИВ С ПОВТОРЕНИЯМИ 
    foreach($count as $room => $amount){
        // ПОЛУЧАЕМ КОЛИЧЕСТВО НОМЕРОВ ПО ID
        $amount_rooms = mysqli_fetch_array(mysqli_query($con, "SELECT id_room, amount_in_hotel FROM rooms WHERE id_room=$room"));
        // СЧИТАЕМ ОСТАВШИЕСЯ
        $exist = $amount_rooms[1] - $amount ;
        echo "Номер: $room <br> Осталось:$exist <br>";
        // ЕСЛИ МАКСИМУМ РАВЕН ЗАБРОНИРОВАННЫМ ТО ВЫВОДИМ ЧТО ВСЕ
        if($amount == $amount_rooms[1]){
            echo "Больше нельзя бронировать номер $room <br>";
        }
    }
?>
<!-- C:\OSPanel\domains\coursework\database\Admin_info.php -->