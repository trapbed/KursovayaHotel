<?php
require_once "../database/Admin_create.php";
session_start();
$page = isset($_SESSION['page_admin']) ? $_SESSION['page_admin'] :false;


if(!isset($_POST['act'])){
    header("Location: ../admin/index.php?page_admin=$page");
}
else{
    if($_POST['act'] == 'service'){
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $desc = isset($_POST['desc']) ? $_POST['desc'] : "";
        $cat = isset($_POST['cat']) ? $_POST['cat'] : "";
        $price = isset($_POST['price']) ? $_POST['price'] : "";
        $img = ($_FILES['img'] != "") ? $_FILES['img']['name'] : "";
        if($name && $desc && $cat && $price  && $img){
            $price = floatval($price);
            if(substr($_FILES['img']['type'], 0, 5) != 'image'){
                $_SESSION['message'] = 'Тип отправленного файла не является изображением. Пожалуйста отправьте изображение! ';
                header("Location: ../admin/createService.php");
                $_SESSION['create_serv'] = ['name'=>$name, 'desc'=>$desc, 'cat'=>$cat, 'price'=>$price, 'img'=>$img];
            }
            if(!is_float($price) ){
                $_SESSION['message'] = "Неверный формат цены. Цена должна быть с плавающей точкой";
                header("Location: ../admin/createService.php");
                $_SESSION['create_serv'] = ['name'=>$name, 'desc'=>$desc, 'cat'=>$cat, 'price'=>$price, 'img'=>$img];
            }
            else{
                $service = new Create();
                $service = $service->create_service($name,$desc, $cat, $price, $img);
            }
        }
        else{
            $page = "services";
            $_SESSION['message'] = "Заполните все поля!";
            $_SESSION['create_serv'] = ['name'=>$name, 'desc'=>$desc, 'cat'=>$cat, 'price'=>$price, 'img'=>$img];
            echo "sdnjdsnj";
            header("Location: ../admin/createService.php");
            // header("Location: ../admin/index.php?page_admin=services");
        }
        
    }
}
?>