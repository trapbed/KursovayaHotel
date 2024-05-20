<?php
require_once "Connect.php";

class Service extends Connect{
    // protected $idS ;
    // protected $nameS ;
    // protected $descS ;
    // protected $idCS ;
    // protected $nameCS ;
    // protected $imgS ;
    // protected $priceS ;

    public function get_services(){
        $services = mysqli_fetch_all(mysqli_query($this->conn, "SELECT id_service, name_service, desc_service, cat_service, cat_services.name_cat_service, img_service, price_service FROM service JOIN cat_services ON cat_services.id_cat_service=service.cat_service"));
        return $services;
    }
    public function get_cat_serv(){
        $catServ = mysqli_fetch_all(mysqli_query($this->conn, "SELECT * FROM cat_services"));
        return $catServ;
    }
    public function services_all($cat){
        $servicesAll = mysqli_query($this->conn, "SELECT * FROM service WHERE cat_service=".$cat);
        return $servicesAll;
    }
}
?>

<!-- public function get_applications_user(){
        $query = "SELECT * FROM applications WHERE user_id = ".$_SESSION['id_user'];
        $appls = mysqli_fetch_all(mysqli_query($this->connection, $query));
        return $appls;
    } -->