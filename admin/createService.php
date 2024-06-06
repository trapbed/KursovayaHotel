<!-- createAdmin.php?act=room&page_admin=rooms -->
<?php

include "../header.php";
require_once "../database/Admin_info.php";
$saved = isset($_SESSION['create_serv']) ? $_SESSION['create_serv'] : false;
$name =  ($saved != false) ? $saved['name'] : false;
$desc =  ($saved != false) ? $saved['desc']:false;
$cat =   ($saved != false) ? $saved['cat']:false;
$price = ($saved != false) ? $saved['price']:false;
$img =   ($saved != false) ? $saved['img']:false;


// print_r($saved);
    echo "<section class='changeAdminDiv'>
    <h4>Создание услуги</h4>
    <div id='formNOldImg'>
        <form action='createAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
            <input type='hidden' name='act' value='service'>
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
                <select name='cat'>
                    <option value=''>Выберите категорию</option>";
                    $cat_serv = new Info();
                    $cat_serv = $cat_serv->get_info_cat_serv();
                    foreach($cat_serv as $cs){
                        if($cat == $cs[0]){
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
                <input type='text' name='price' value='$price' pattern='\d+(\.\d{,2})?' placeholder='00.00'>
            </label>
            <label for='img' class='labelAdminChange'>
                Изображение
                <input type='file' name='img'>
            </label>
            <input type='submit' value='Создать'>
        </form>
    </div>
    
    </section>";


require_once "../footer.php";

?>