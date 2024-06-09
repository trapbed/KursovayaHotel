<?php
require_once "../header.php";
require_once "../database/Admin_info.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
$cat_room = new Info();
$cat_room = $cat_room->get_info_cat_room_by_id($id);

$name = $cat_room[1];
$square = $cat_room[5];
$max = $cat_room[4];
$amount_room_in_room = $cat_room[2];
$price = $cat_room[6];
// $name = $name['array'][1];

echo "<section class='changeAdminDiv'>
<h4>Редактирование категории номера</h4>
<div id='formNOldImg'>
    <form action='changeAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
        <input type='hidden' name='action' value='updateCatRoom'>
        <input type='hidden' name='id' value='$id'>
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
        <input type='submit' value='Сохранить'>
    </form>
</div>

</section>";


require_once "../footer.php";

?>