<?php
require_once "Connect.php";

class Book extends Connect{
    public function check_date($dateArrival, $dateDeparture){
        $r_date = mysqli_fetch_all(mysqli_query($this->conn, "SELECT date, book FROM occupied_rooms WHERE date>='$dateArrival' AND date<='$dateDeparture'"));
        $arr_no_exist = [];

        foreach($r_date as $date){
            $one_day = $date[1];
            $count = 0;
            $arr_book = (array) json_decode($one_day);
            foreach($arr_book as $room => $amount){
                $room_info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT amount_in_hotel, id_room FROM rooms WHERE id_room = $room"));
                $room_max = $room_info[0]; 
                $exist = $room_max-$amount;
                if($exist == 0){
                    $no_exist = $room_info[1];
                    array_push($arr_no_exist, $no_exist);
                }
            }
            $count++;
        }
        return $arr_no_exist;
    }

    public function new_book($dateArrival, $dateDepart, $idRoom, $idUser){
        $occupied_rooms = mysqli_fetch_all(mysqli_query($this->conn, "SELECT date, book FROM occupied_rooms WHERE date>=$dateArrival AND date<=$dateDepart"));
        foreach($occupied_rooms as $date => $room){
            // print_r($date);
        }
    }
}


?>