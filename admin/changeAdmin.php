<?php
require_once "../database/Admin_change.php";

if(!isset($_POST['action'])){
    $_SESSION['message'] = "Нет действия!";
    header("Location: ../admin/index.php?page_admin=services");
}
else{
    $act = $_POST['action'];
    if($act == 'updateServ'){
        $id_serv = $_POST['id_serv'];
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $desc = isset($_POST['desc']) ? $_POST['desc'] : false;
        $cat = isset($_POST['cat']) ? $_POST['cat'] : false;
        $price = isset($_POST['price']) ? $_POST['price'] : false;
        $img = $_FILES['img']['name']!= "" ? $_FILES['img']['name'] : $_POST['oldImg'];
        if(substr($_FILES['img']['type'], 0, 5) != 'image'){
            $_SESSION['message'] = 'Тип отправленного файла не является изображением. Пожалуйста отправьте изображение! ';
            header("Location: ../admin/index.php?page_admin=services");
        }
        else{
            $changeServ = new Change();
            $changeServ = $changeServ->update_serv($id_serv, $name, $desc, $cat, $price, $img);
        }
    }
    if($act == 'updateCatServ'){
        $id = isset($_POST['id']) ? $_POST['id'] : false ;
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        echo $act, $id, $name;
        // 
        $check_old = new Info();
        $check_old = $check_old->get_info_one_cat_serv($id);
        // print_r($check_old);

        $check_exist = new Info();
        $check_exist = $check_exist->get_info_cat_serv_by_name($name);

        if($check_old['array'][1] == $name){
            $_SESSION['message'] = "Данные актуальны!";
            header("Location: ../admin/index.php?page_admin=catServices");
        }
        if($check_exist['array'][1] == $name){
            $_SESSION['message'] = "Такая категория уже существует!";
            header("Location: ../admin/updateCatServ.php?id=$id");
        }
        else{
            $update_cat_serv = new Change();
            $update_cat_serv = $update_cat_serv->update_name_cat_serv($id, $name);
        }
    }
    if($act == 'updateRoom'){
        $id = $_POST['id'];
        $old_room = new Info();

        $long = isset($_POST['long']) ? $_POST['long'] : false;
        $short = isset($_POST['short']) ? $_POST['short'] : false;
        $desc = isset($_POST['desc']) ? $_POST['desc'] : false;
        $img = isset($_FILES['img']) ? $_FILES['img']['name'] : false;
        $cat = isset($_POST['cat']) ? $_POST['cat'] : false;
        $amount = isset($_POST['amount']) ? $_POST['amount'] : false;
        $old_room = $old_room->get_info_room_by_id($id);
        if($long && $short && $desc && $img && $cat && $amount){
            $check_exist_name = new Info();
            $check_exist_name = $check_exist_name->check_name_room($long, $short);
            if($old_room[1] == $long && $old_room[2]==$short && $old_room[3] == $desc && $old_room[4] == $img && $old_room[5] == $cat && $old_room[6] == $amount ){
                $_SESSION['message'] = "Актуальные данные!";
                header("Location: ../admin/updateRoom.php?id=$id");
            }
            if($check_exist_name == "no"){
                $_SESSION['message'] = $check_exist_name;
                $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount,'img'=>$img];
                header("Location: ../admin/updateRoom.php?id=$id");
            }
            if(substr($_FILES['img']['type'], 0, 5) != 'image'){
                $_SESSION['message'] = 'Тип отправленного файла не является изображением. Пожалуйста отправьте изображение! ';
                $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount_rooms,'img'=>$img];
                header("Location: ../admin/updateRoom.php?id=$id");
            }
            else{
                $update_room = new Change();
                $update_room = $update_room->update_room($id, $long, $short, $desc, $img, $cat, $amount);
            }
        }
        else{
            $_SESSION['message'] = "Заполните все поля!";
            header("Location: ../admin/updateRoom.php?id=$id");
        }
        echo $long,
        $short ,
        $desc,
        $img,
        $cat,
        $amount;
        // if()
    }
}

?>