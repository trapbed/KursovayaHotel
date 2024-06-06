<!-- createAdmin.php?act=room&page_admin=rooms -->
<?php

include "../header.php";
require_once "../database/Admin_info.php";
// print_r($_SESSION['create_room']);
$saved = isset($_SESSION['create_room']) ? $_SESSION['create_room'] : false;
$long_name =  ($saved != false) ? $saved['long_name'] : false;
$short_name =  ($saved != false) ? $saved['short_name'] : false;
$desc =  ($saved != false) ? $saved['desc']:false;
$cat =   ($saved != false) ? $saved['cat']:false;
$amount_rooms = ($saved != false) ? $saved['amount_rooms']:false;
$img =   ($saved != false) ? $saved['img']:false;


// print_r($saved);
    echo "<section class='changeAdminDiv'>
    <h4>Создание номера</h4>
    <div id='formNOldImg'>
        <form action='createAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
                <input type='hidden' name='act' value='room'>
            <label for='long_name' class='labelAdminChange'>
                Длинное название номера
                <input type='text' name='long_name' value='$long_name'>
            </label>
            <label for='short_name' class='labelAdminChange'>
                Короткое название номера
                <input type='text' name='short_name' value='$short_name'>
            </label>
            <label for='cat_room' class='labelAdminChange'>
                Категория номера
                <select name='cat_room'>
                    <option value=''>Выберите категорию</option>";
                    $cat_room = new Info();
                    $cat_room = $cat_room->get_cats_room();
                    foreach($cat_room as $cs){
                        echo "<option value='".$cs[0]."'";
                        if($cat == $cs[0]){
                            echo " selected ";
                        }
                        echo ">".$cs[1]."</option>";
                    }
                echo "</select>";
                echo "<label for='amount_rooms' class='labelAdminChange'>
                    Количество номеров
                    <input type='number' name='amount_rooms' value='$amount_rooms'>
                </label>
            <label for='desc' class='labelAdminChange'>
                Описание
                <input type='text' name='desc' value='$desc'>
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