<?php

require_once "Connect.php";

class Rooms extends Connect{

// ПРОВЕРКА НА НАЛИЧИЕ СТРОК
    public function exist_rows($rooms){
        $check_rows = false;
        if(mysqli_num_rows($rooms) != 0){
            $check_rows =true;
        }
        else{
            $check_rows =false;
        }
            return $check_rows;
    }
// ВЫВОД ВСЕЙ ИНФЫ О НОМЕРАХ 
    public function output_info($query){
        $query = mysqli_fetch_all(mysqli_query($this->conn, $query));
        return $query;
    }
// ВЫВОД ФИЛЬТР КОЛИЧЕСТВО КОМНАТ
    public function get_room_in_room(){
        $room_in_r = mysqli_fetch_all(mysqli_query($this->conn, "SELECT DISTINCT amount_room_in_room FROM cat_rooms"));
        return $room_in_r;
    }
// ВЫВОД ФИЛЬТР КАТЕГОРИИ
    public function get_cat_name(){
        $cat_nameR = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_cat_room, name_cat_room FROM cat_rooms WHERE exist='1'"));
        return $cat_nameR;
    }
// ВЫВОД ФИЛЬР КОЛ-ВО ГОСТЕЙ
    public function get_end_pers($num){
        switch ($num){
            case 1:
                $end = 'комната';
                break;
            case 5:
                $end ='комнат';
                break;
            default:
                $end = 'комнаты';
                break;
        }
        return $end;
    }
// ВЫВОД НОМЕРОВ
    public function get_rooms(){
        $query = "SELECT id_room, long_name_room, short_name_room, desc_room, img_room, rooms.id_cat_room, amount_in_hotel , name_cat_room, amount_room_in_room, max_pers, square_cat_room, price_cat_room FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room  WHERE rooms.exist='1'";
        $rooms = mysqli_query($this->conn, $query);
        $check_rows = $this -> exist_rows($rooms);
        if($check_rows){
            return [$check_rows, $query];
        }
        else{
            return $check_rows;
        }

        // }
    }
// ВЫВОД ИНФЫ ОДНОГО НОМЕРА
    public function get_one_room($id_room){
        $room = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id_room, long_name_room, short_name_room, desc_room, img_room, cat_rooms.name_cat_room, amount_in_hotel , name_cat_room, amount_room_in_room, max_pers, square_cat_room, price_cat_room FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room WHERE id_room=".$id_room));
        return $room;
    }
// ЗАПРОС В КАТАЛОГЕ
    public function search_catalog($numPers, $numRooms, $cat, $dateArrival, $dateDeparture){
        $numPers = ($numPers != "") ? $numPers : false ;
        $numRooms = ($numRooms != "") ? $numRooms : false ;
        $cat = ($cat != "") ? $cat : false ;
        $dateArrival = ($dateArrival != "") ? $dateArrival : false ;
        $dateDeparture = ($dateDeparture != "") ? $dateDeparture : false ;
        $check_and = true;

        $query = "SELECT id_room, long_name_room, short_name_room, desc_room, img_room, rooms.id_cat_room, amount_in_hotel , name_cat_room, amount_room_in_room, max_pers, square_cat_room, price_cat_room FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room WHERE rooms.exist='1'";
           
        if($numPers){
                $check_and =true;
                if($check_and == true){
                    $query .= " AND ";
                }
                else{
                    $query .= " WHERE ";
                }
                $query .= " max_pers = $numPers ";
            }
            if($numRooms){
                $check_and =true;
                if($check_and == true){
                    $query .= " AND ";
                }
                else{
                    $query .= " WHERE ";
                }
                $query .= " amount_room_in_room = $numRooms ";
            }
            if($cat){
                $check_and =true;
                if($check_and == true){
                    $query .= " AND ";
                }
                else{
                    $query .= " WHERE ";
                }
                $query .= " cat_rooms.id_cat_room = $cat ";
            }
            if($dateArrival){
                $check_and =true;
                if($check_and == true){
                    $query .= " AND ";
                }
                else{
                    $query .= " WHERE ";
                }
                $query .= " cat_rooms.price_cat_room >= $dateArrival ";
            }
            if($dateDeparture){
                $check_and =true;
                if($check_and == true){
                    $query .= " AND ";
                }
                else{
                    $query .= " WHERE ";
                }
                $query .= "cat_rooms.price_cat_room <= $dateDeparture";
            }
            $rooms = mysqli_query($this->conn, $query);
            $check_rows = $this -> exist_rows($rooms);
            if($check_rows){
                return [$check_rows, $query];
            }
            else{
                return $check_rows;
            }

        }
    }
?>