<?php

require_once "Connect.php";

class Rooms extends Connect{
// ВЫВОД ФИЛЬТР КОЛИЧЕСТВО КОМНАТ
    public function get_room_in_room(){
        $room_in_r = mysqli_fetch_all(mysqli_query($this->conn, "SELECT DISTINCT amount_room_in_room FROM cat_rooms"));
        return $room_in_r;
    }
// ВЫВОД ФИЛЬТР КАТЕГОРИИ
    public function get_cat_name(){
        $cat_nameR = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_cat_room, name_cat_room FROM cat_rooms "));
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
        $allRooms = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_room, long_name_room, short_name_room, desc_room, img_room, rooms.id_cat_room, amount_in_hotel , name_cat_room, amount_room_in_room, max_pers, square_cat_room, price_cat_room FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room"));
        return $allRooms;
    }
// ВЫВОД ИНФЫ ОДНОГО НОМЕРА
    public function get_one_room($id_room){
        $room = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id_room, long_name_room, short_name_room, desc_room, img_room, cat_rooms.name_cat_room, amount_in_hotel , name_cat_room, amount_room_in_room, max_pers, square_cat_room, price_cat_room FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room WHERE id_room=".$id_room));
        return $room;
    }
}

?>