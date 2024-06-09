<?php
// require_once "../database/Admin_info.php";



    $dateA = date('2024-06-10');
    $dateD = date('2024-06-12');
    $con = mysqli_connect("localhost", "root", "", "lion");

    $r_date = mysqli_fetch_all(mysqli_query($con, "SELECT date, book FROM occupied_rooms WHERE date>='$dateA' AND date<='$dateD'"));
    $arr_no_exist = [];

    foreach($r_date as $date){
        $one_day = $date[1];
        // print_r($r_date);
        $count = 0;
        $arr_book = (array) json_decode($one_day);
        print_r($arr_book);
        // echo $r_date[$count][0]."<br>";
        foreach($arr_book as $room => $amount){
            $room_info = mysqli_fetch_array(mysqli_query($con, "SELECT amount_in_hotel, id_room FROM rooms WHERE id_room = $room"));
            $room_max = $room_info[0]; 
            $exist = $room_max-$amount;
            // echo "Номер:$room<br>";
            // echo "Всего: $room_max <br>";
            // echo "Забронированно: $amount <br>";
            // echo "Осталось: $exist <br><br>";
            
            if($exist == 0){
                $no_exist = $room_info[1];
                array_push($arr_no_exist, $no_exist);
            }
            // echo "Номер".$room."    Количество".$amount."<br>";
        }
        $count++;
        // print_r($arr_book);
        // print_r($date);
        print_r($arr_no_exist);
    }
    // print_r($r_date);
    
?>
<!-- C:\OSPanel\domains\coursework\database\Admin_info.php -->