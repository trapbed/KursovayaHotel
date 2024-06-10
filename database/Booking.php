<?php
require_once "Connect.php";
session_start();

class Book extends Connect{
    public function get_email_user($idUser){
        $user_email = mysqli_fetch_array(mysqli_query($this->conn, "SELECT email FROM `users` WHERE id_user=$idUser"))[0];
        return $user_email;
    }
    
    public function get_name_room($idRoom){
        $room_name = mysqli_fetch_array(mysqli_query($this->conn, "SELECT long_name_room FROM `rooms` WHERE id_room=$idRoom"))[0];
        return $room_name;
    }
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
    
    public function get_array_book($idRoom){
        $array_book = [];
        $query = mysqli_query($this->conn, "SELECT id_room FROM rooms ORDER BY `rooms`.`id_room` ASC");
        $room = mysqli_fetch_all($query);
        $rows = mysqli_num_rows($query);
        $count = 0;
        while($count < $rows){
            $id_room = (int)$room[$count][0];
            $value = 0;
            if($id_room == $idRoom){
                $value = 1;
            }
            $array_book["$id_room"] = $value;
            $count++;
        }
        $array_book = json_encode($array_book);
        return $array_book;
    }

    public  function get_exist_dates($dateArrival, $dateDepart){
        $exist_dates = [];
        $get_dates = mysqli_query($this->conn, "SELECT date FROM occupied_rooms WHERE date<='$dateDepart' AND date>='$dateArrival'");
        $array_dates = mysqli_fetch_all($get_dates);
        $num_dates = mysqli_num_rows($get_dates);
        // многомерный массив в одномерный
        $exist = array();
        echo "<hr>";
        print_r($array_dates);
        foreach($array_dates as $date){
            $exist = array_merge($exist,$date);
        }
        echo "<br>";
        print_r($exist);
        print_r($num_dates);

        return [
            'array_dates'=>$exist ,
            'num_rows'=>$num_dates 
        ];
    }

    public function all_dates_between($dateArrival, $dateDepart){
        // массив из всех дат между заселением и выселением
        $arr_between_dates = [];
        while(date($dateArrival )<= date($dateDepart)){
            array_push($arr_between_dates, $dateArrival);
            $dateArrival = strtotime("$dateArrival +1day");
            $dateArrival = date("Y-m-d", $dateArrival);
        }
        return $arr_between_dates;
    }
    
    public function crate_arr_non_exist_dates($dateArrival, $dateDepart, $exist, $array_between_dates){
        $non_exist_dates = array_diff($array_between_dates, $exist);
        return $non_exist_dates;
    }

    public function check_key($date, $id_room){
        $book = mysqli_fetch_array(mysqli_query($this->conn, "SELECT book FROM occupied_rooms WHERE date='$date'"))[0];
        $book_array = (array) json_decode($book);
        $old_room = json_encode($book_array);
        $insert_array = [];
        foreach($book_array as $room => $amount){
            $insert_array["$room"] = $amount;
            if($room == $id_room){
                $insert_array["$room"] = $amount+1;
            }
        }
        return [
            'date' => $date,
            'insert_array' => $insert_array,
            'old_room' => $old_room
        ];
    }

    public function insert_book($array_between_dates, $exist_dates, $non_exist_dates, $array_rooms, $id_room){
        $array_result = [];
        $array_sql = [];
        $old_info = [];
        foreach($array_between_dates as $all_dates){
            foreach($exist_dates as $exist){
                if($all_dates == $exist){
                    $check_key = new Book();
                    $check_key = $check_key->check_key($all_dates, $id_room);
                    $date = $check_key['date'];
                    $insert = json_encode($check_key['insert_array']);
                    
                    $old_room = $check_key['old_room'];
                    $old_info["$all_dates"] = $old_room;
                    $query = "UPDATE occupied_rooms SET `book` = '$insert' WHERE date = '$date'";
                    array_push($array_sql, $query);
                }
            }
            foreach($non_exist_dates as $non_exist){
                if($all_dates == $non_exist){
                    $query = "INSERT INTO `occupied_rooms` (`date`, `book`) VALUES ('$all_dates', '$array_rooms')";
                    $old_info["$all_dates"] = $array_rooms;
                    array_push($array_sql, $query);

                }
            }

        }
       
        
        foreach($array_sql as $sql){
            $end_query = mysqli_query($this->conn, $sql);
            if($end_query){
                array_push($array_result, 'true');
                $result = true;
            }
            else{
                array_push($array_result, 'false');
                foreach($old_info as $date => $query){
                    $sql = "UPDATE occupied_rooms SET `book` = '$query' WHERE date = '$date'";
                    $end_query = mysqli_query($this->conn, $end_query);
                    $result = false;
                }
            }
        }
        $all = count($array_result);
        $true = array_count_values($array_result)['true'];
        return ['result' =>$result, 
                'old_info' => $old_info];
    }
    
    public function insert_into_book($idUser, $idRoom, $dateArrival, $dateDepart, $old_info){
        $result = false;
        $sql = "INSERT INTO `book`(`id_user`, `id_room`, `date_arrival`, `date_departure`) VALUES ($idUser,$idRoom,'$dateArrival','$dateDepart')";
        $query = mysqli_query($this->conn, $sql);
        if($query){
            $result = true;
        }
        else{
            foreach($old_info as $date => $query){
                $sql = "UPDATE occupied_rooms SET `book` = '$query' WHERE date = '$date'";
                $end_query = mysqli_query($this->conn, $end_query);
            }
        }
        return $result;
    }

    
}


?>