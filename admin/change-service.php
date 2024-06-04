<?php

include "../header.php";
require_once "../database/Admin_info.php";

$id_serv = isset($_GET['id_serv']) ? $_GET['id_serv'] : false ;

$infoServ = new Info();
$infoServ = $infoServ->get_info_one_serv($id_serv);

if($id_serv){
    $name = $infoServ[1];
    $desc = $infoServ[2];
    $cat = $infoServ[0];
    $price = $infoServ[5];
    $img = $infoServ[4];
    echo "<section class='changeAdminDiv'>
    <h4>Редактирование услуги</h4>
    <div id='formNOldImg'>
        <form action='changeAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
            <input type='hidden' name='oldImg' value='$img'>
            <input type='hidden' name='action' value='updateServ'>
            <input type='hidden' name='id_serv' value='$id_serv'>
            <label for='name' class='labelAdminChange'>
                Название услуги
                <input type='text' name='name' value='$name'>
            </label>
            <label for='desc' class='labelAdminChange'>
                Описание услуги
                <input type='text' name='desc' value='$desc'>
            </label>
            <label for='cat' class='labelAdminChange'>
                Категория услуги
                <select name='cat'>";
                    $cat_serv = new Info();
                    $cat_serv = $cat_serv->get_info_cat_serv();
                    foreach($cat_serv as $cs){
                        if($cat == $cs[1]){
                            echo" <option value='".$cs[0]."' selected>".$cs[1]."</option>";
                        }
                        else{
                            echo" <option value='".$cs[0]."'>".$cs[1]."</option>";
                        }
                    }
                echo "</select>
            </label>
            <label for='price' class='labelAdminChange'>
                Цена
                <input type='text' name='price' value='$price' pattern='\d+(\.\d{,2})?'>
            </label>
            <label for='img' class='labelAdminChange'>
                Изображение
                <input type='file' name='img' value='$img'>
            </label>
            <input type='submit' value='Сохранить'>
        </form>
        <div id='oldServImg'>
            <img src='../img/services/$img' alt='service'>
        </div>
    </div>
    
    </section>";
}
else{
    echo "<script>location.href='../admin/index.php?page_admin=services';</script>";
}

require_once "../footer.php";

?>
