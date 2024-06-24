<?php
require_once "Connect.php";

class Service extends Connect{
// Вывод услуг
    public function get_services(){
        $services = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_service, name_service, desc_service, cat_service, cat_services.name_cat_service, img_service, price_service FROM service JOIN cat_services ON cat_services.id_cat_service=service.cat_service WHERE service.exist = '1'"));
        return $services;
    }
// Вывод категорий услуг
    public function get_cat_serv(){
        $query = mysqli_query($this->conn, "SELECT * FROM cat_services WHERE exist='1'");
        $num_row = mysqli_num_rows($query);
        $catServ = mysqli_fetch_all($query);
        return [
            'num_row' => $num_row,
            'array' => $catServ
        ];
    }
// Вывод по категориям
    public function services_all($cat){
        $servicesAll = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM service WHERE cat_service=".$cat." AND service.exist = '1'"));
        return $servicesAll;
    }

    public function get_array_from_id_cat_service(){
        $query = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_cat_service, name_cat_service FROM cat_services"));
        // print_r($query);
        return $query;
    }
    public function get_id_cat_serv($id){
        $query = mysqli_fetch_array(mysqli_query($this->conn, "SELECT cat_service FROM service WHERE id_service = $id"));
    }

    public function get_services_by_cat($id_cat){
        $query = mysqli_query($this->conn, "SELECT * FROM service WHERE cat_service = $id_cat");
        $array = mysqli_fetch_all($query);
        $num_row = mysqli_num_rows($query);
        return [
            'array' => $array,
            'num_row' =>$num_row
        ];
    }


    public function get_more_info($what, $id){
        if($what == 'serv_desc'){
            $info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT desc_service, price_service FROM service WHERE name_service = '$id'"));
            // $info = $info[0];
        }
        return $info;
    }
// 
    public function get_title($id, $what){
        $title = "Название услуги :".$id;
        return $title;
    }
}
?>