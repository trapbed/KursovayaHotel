<?php
require_once "../database/Admin_change.php";

if(!isset($_POST['action'])){
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
        // print_r($_FILES['img']);
        // echo substr($_FILES['img']['type'], 0, 5);
        if(substr($_FILES['img']['type'], 0, 5) != 'image'){
            $_SESSION['message'] = 'Тип отправленного файла не является изображением. Пожалуйста отправьте изображение! ';
            header("Location: ../admin/index.php?page_admin=services");
        }
        else{
            $changeServ = new Change();
            $changeServ = $changeServ->update_serv($id_serv, $name, $desc, $cat, $price, $img);
        }
        // var_dump($img);
    }
}

?>