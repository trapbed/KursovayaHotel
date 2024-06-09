<?php
require_once "../database/Admin_create.php";
session_start();
$page = isset($_SESSION['page_admin']) ? $_SESSION['page_admin'] :false;
$act = isset($_POST['act']) ? $_POST['act'] : false;

if($_POST['act'] == false){
    header("Location: ../admin/index.php?page_admin=$page");
}
else{
    if($_POST['act'] == 'service'){
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $desc = isset($_POST['desc']) ? $_POST['desc'] : "";
        $cat = isset($_POST['cat']) ? $_POST['cat'] : "";
        $price = isset($_POST['price']) ? $_POST['price'] : "";
        $img = ($_FILES['img'] != "") ? $_FILES['img'] : "";
        if($name && $desc && $cat && $price  && $img){
            $price = floatval($price);
            if(substr($_FILES['img']['type'], 0, 5) != 'image'){
                $_SESSION['message'] = 'Тип отправленного файла не является изображением. Пожалуйста отправьте изображение! ';
                header("Location: createService.php");
                $_SESSION['create_serv'] = ['name'=>$name, 'desc'=>$desc, 'cat'=>$cat, 'price'=>$price, 'img'=>$img];
            }
            if(!is_float($price) ){
                $_SESSION['message'] = "Неверный формат цены. Цена должна быть с плавающей точкой";
                header("Location: createService.php");
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
            header("Location: createService.php");
            // header("Location: ../admin/index.php?page_admin=services");
        }
        
    }
    // echo $_POST['act'];
    if($_POST['act'] == 'catService'){
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $check = new Info();
        $check = $check->get_info_cat_serv_by_name($name);
        if($name){
            if($check['num_row'] != 0){
                $_SESSION['message'] = "Такая категория услуг уже есть!";
                header("Location: ../admin/index.php?page_admin=catServices");
            }
            else{
                $create = new Create();
                $create = $create->create_cat_service($name);
            }
        }
        else{
            $_SESSION['message'] = "Заполните все поля";
            header("Location: ../admin/index.php?page_admin=catServices");
        }
        
    }
    // 
    if($_POST['act'] == 'room'){
        $long_name = isset($_POST['long_name']) ? $_POST['long_name'] : false;
        $short_name = isset($_POST['short_name']) ? $_POST['short_name'] : false;
        $desc = isset($_POST['desc']) ? $_POST['desc'] : false;
        $cat = isset($_POST['cat_room']) ? $_POST['cat_room'] : false;
        $amount_rooms = isset($_POST['amount_rooms']) ? $_POST['amount_rooms'] : false;
        $img = isset($_FILES['img']['tmp_name']) ? $_FILES['img'] : false;
        // $tmp = isset($_FILES['img']['tmp_name']) ? $_FILES['img']['tmp_name'] : false;
        echo $long_name, $short_name,$desc,$cat,$amount_rooms, "<br>",$img;
        if($long_name && $short_name && $desc && $cat && $amount_rooms && $img){
            $check_exist_name = new Info();
            $check_exist_name = $check_exist_name->check_name_room($long_name, $short_name);
            if($check_exist_name == "no"){
                $_SESSION['message'] = $check_exist_name;
                $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount_rooms,'img'=>$img];
                header("Location: ../admin/createRoom.php");
            }
            if(substr($_FILES['img']['type'], 0, 5) != 'image'){
                $_SESSION['message'] = 'Тип отправленного файла не является изображением. Пожалуйста отправьте изображение! ';
                $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount_rooms,'img'=>$img];
                header("Location: ../admin/createRoom.php");
            }
            else{
                $create_room = new Create();
                $create_room = $create_room->create_room($long_name, $short_name, $desc, $cat, $amount_rooms, $img, $tmp);
            }
        }
        else{
            $_SESSION['message'] = "Заполните все поля!";
            $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount_rooms,'img'=>$img];
            // header("Location: ../admin/createRoom.php");
        }
    }
    // 
    if($_POST['act'] == 'cat_room'){
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $square = isset($_POST['square']) ? $_POST['square'] : false;
        $max = isset($_POST['max']) ? $_POST['max'] : false;
        $amount_room_in_room = isset($_POST['amount_room_in_room']) ? $_POST['amount_room_in_room'] : false;
        $price = isset($_POST['price']) ? $_POST['price'] : false;

        if($name && $square && $max && $amount_room_in_room && $price){
            $check_name_cat = new Info();
            $check_name_cat = $check_name_cat->get_info_cat_room_by_name($name);    
            if($check_name_cat['num_row']>0){
                $_SESSION['message'] = "Такая категория уже существует!";
                $_SESSION['create_cat_room'] = [
                    'name'=>$name, 
                    'square'=>$square, 
                    'max'=>$max, 
                    'amount_room_in_room'=>$amount_room_in_room, 
                    'price'=>$price
                ];
                echo "<script>
                    location.href = '../admin/createCatRoom.php';
                </script>";
            }
            else{
                $new_cat_room = new Create();
                $new_cat_room = $new_cat_room->create_cat_room($name, $square, $max, $amount_room_in_room, $price, 0);
            }
        }
        else{
            $_SESSION['message'] = "Заполните все поля!";
            $_SESSION['create_cat_room'] = [
                'name'=>$name, 
                'square'=>$square, 
                'max'=>$max, 
                'amount_room_in_room'=>$amount_room_in_room, 
                'price'=>$price
            ];
            echo "<script>
                location.href = '../admin/createCatRoom.php';
            </script>";

        }
    }
}
?>