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
        $catServ = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM cat_services WHERE exist='1'"));
        return $catServ;
    }
// Вывод по категориям
    public function services_all($cat){
        $servicesAll = mysqli_query($this->conn, "SELECT * FROM service WHERE cat_service=".$cat." AND service.exist = '1'");
        return $servicesAll;
    }
}
?>