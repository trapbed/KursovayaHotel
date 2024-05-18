<?php
    require_once "Connect.php";

    class Info extends Connect{
        public function get_info_room(){
            $query = mysqli_fetch_all(mysqli_query($this->conn , "SELECT rooms.img_room, rooms.short_name_room, cat_rooms.name_cat_room, rooms.desc_room, rooms.long_name_room, rooms.amount_in_hotel FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room;"));
            return $query;
        }

        public function get_info_user(){
            $query_user = mysqli_fetch_all(mysqli_query($this->conn, "SELECT buyer.name, buyer.sname, buyer.pathronymic, buyer.birthday, buyer.phone, users.email, buyer.blocked, users.role FROM buyer JOIN users ON users.id_user= buyer.id_user;"));
            return $query_user;
        }
    }