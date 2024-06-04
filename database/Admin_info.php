<?php
    require_once "Connect.php";

class Info extends Connect{
    // ИНФА О НОМЕРАХ
        public function get_info_room(){
            $query = mysqli_fetch_all(mysqli_query($this->conn , "SELECT rooms.img_room, rooms.short_name_room, cat_rooms.name_cat_room, rooms.desc_room, rooms.long_name_room, rooms.amount_in_hotel, rooms.id_room FROM rooms JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room;"));
            return $query;
        }
    // ИНФА О ПОЛЬЗОВАТЕЛЯХ
        public function get_info_user(){
            // $query_user = mysqli_fetch_all(mysqli_query($this->conn, "SELECT buyer.id_buyer, buyer.name, buyer.sname, buyer.pathronymic, buyer.birthday, buyer.phone, users.email, buyer.blocked, users.role FROM buyer JOIN users ON users.id_user= buyer.id_user;"));
            $query_user = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM users ORDER BY role ASC"));
            return $query_user;
        }
    // ИНФА О ПОКУПАТЕЛЕ
        public function get_info_buyer($id){
            $query_buyer = mysqli_fetch_array(mysqli_query($this->conn, "SELECT buyer.name, buyer.sname, buyer.pathronymic, buyer.birthday, buyer.phone FROM buyer JOIN users ON users.id_user= buyer.id_user  WHERE buyer.id_user = $id;"));
            return $query_buyer;
        }
    // КАТЕГОРИИ НОМЕРОВ
        public function get_cats_room(){
            $query_cat_room = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM `cat_rooms`"));
            return $query_cat_room;
        }
    // ИНФОРМАЦИЯ О НОМЕРАХ
        public function get_all_book(){
            $book = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_book, users.email, rooms.short_name_room, date_arrival, date_departure, book.status, cat_rooms.price_cat_room FROM `book` JOIN users ON users.id_user=book.id_user JOIN rooms ON rooms.id_room=book.id_room JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room"));
            return $book;
        }
    // ИНФА ОБ УСЛУГАХ
        public function get_info_serv(){
            $query_services = mysqli_fetch_all(mysqli_query($this->conn, "SELECT service.name_service, service.desc_service, cat_services.name_cat_service, service.img_service, service.price_service, id_service FROM `service` JOIN cat_services ON cat_services.id_cat_service=service.cat_service"));
            return $query_services;
        }
    // ИНФА О КАТЕГОРИЯХ УСЛУГ
        public function get_info_cat_serv(){
            $query_cat_serv = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM cat_services"));
            return $query_cat_serv;
        }
    // БОЛЬШЕ ИНфОРМАЦИИ
        public function get_more_info($what, $id){
            if($what == 'room_desc'){
                $info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT desc_room FROM rooms WHERE id_room = $id"));
                // $info = $info[0];
            }
            else if($what == 'room_long_name'){
                $info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT long_name_room FROM rooms WHERE id_room = $id"));
                // $info = $info[0];
            }
            else if($what == 'serv_desc'){
                $info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT desc_service FROM service WHERE id_service = $id"));
                // $info = $info[0];
            }
            return $info;
        }
    // 
        public function get_title($id, $what){
            switch($what){
                case 'room_desc':
                    $title = 'Описание номера';
                    break;
                case 'room_long_name':
                    $title = 'Полное название номера';
                    break;
                case 'serv_desc':
                    $title = 'Описание услуги';
                    break;
            }
            $title = $title."&nbsp;№".$id;
            return $title;
        }
    // 
        public function get_info_one_serv($id){
            $info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT cat_services.name_cat_service, `name_service`, `desc_service`, `cat_service`, `img_service`, `price_service` FROM `service` JOIN cat_services ON cat_services.id_cat_service=service.cat_service WHERE id_service=$id"));
            return $info;
        }
}