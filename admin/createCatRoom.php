<!-- createAdmin.php?act=room&page_admin=rooms -->
<?php

include "../header.php";
require_once "../database/Admin_info.php";
// print_r($_SESSION['create_room']);
$saved = isset($_SESSION['create_cat_room']) ? $_SESSION['create_cat_room'] : false;
$name =  ($saved != false) ? $saved['name'] : false;
$square =  ($saved != false) ? $saved['square'] : false;
$max =  ($saved != false) ? $saved['max']:false;
$amount_room_in_room =   ($saved != false) ? $saved['amount_room_in_room']:false;
$price = ($saved != false) ? $saved['price']:false;


// print_r($saved);
    echo "<section class='changeAdminDiv'>
    <h4>Создание категории номера</h4>
    <div id='formNOldImg'>
        <form action='createAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
                <input type='hidden' name='act' value='cat_room'>
            <label for='name' class='labelAdminChange'>
                Название категории
                <input type='text' name='name' value='$name'>
            </label>
            <label for='square' class='labelAdminChange'>
                Площадь (м2)
                <input type='number' name='square' value='$square'>
            </label>
            <label for='max' class='labelAdminChange'>
                Количество гостей
                <input type='number' name='max' value='$max' max='10'>
            </label>
            <label for='amount_room_in_room' class='labelAdminChange'>
                Количество комнат
                <input type='number' name='amount_room_in_room' value='$amount_room_in_room'>
            </label>
            <label for='price' class='labelAdminChange'>
                Цена
                <input type='text' name='price' value='$price' pattern='[0-9]{,5}.[0-9]{,2}'>
            </label>
            <input type='submit' value='Создать'>
        </form>
    </div>
    
    </section>";


require_once "../footer.php";

?>