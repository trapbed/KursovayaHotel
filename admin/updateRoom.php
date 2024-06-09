<?php
require_once "../header.php";
require_once "../database/Admin_info.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
$room = new Info();
$room = $room->get_info_room_by_id($id);
print_r($room);
// print_r($saved);
    echo "<section class='changeAdminDiv'>
    <h4>Редактирование номера</h4>
    <div id='formNOldImg'>
        <form action='changeAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='updateRoom'>
            <input type='hidden' name='id' value='$room[0]'>

            <label for='long' class='labelAdminChange'>
                Длинное название номера
                <input type='text' name='long' value='$room[1]'>
            </label>
            <label for='short' class='labelAdminChange'>
                Короткое название номера
                <input type='text' name='short' value='$room[2]'>
            </label>
            <label for='desc' class='labelAdminChange'>
                Описание номера
                <input type='text' name='desc' value='$room[3]'>
            </label>
            <label for='img' class='labelAdminChange'>
                Изображение номера
                <input type='file' name='img' value='$room[4]'>
            </label>
            <label for='cat' class='labelAdminChange'>
                Название категории номера
                <select name='cat'>";
                $cat_room = new Info();
                $cat_room = $cat_room->get_cats_room_exist();
                foreach($cat_room as $cr){
                    echo "<option value='$cr[0]' ";
                    if($cr[0] == $room[5]){
                        echo " selected ";
                    }
                    echo ">$cr[1]</option>";
                }
                echo "</select>
            </label>
            <label for='amount' class='labelAdminChange'>
                Количество номеров
                <input type='number' name='amount' value='$room[5]'>
            </label>
            <input type='submit' value='Сохранить'>
        </form>
        <div id='oldServImg'>
            <img src='../img/rooms/$room[4]' alt='service'>
        </div>
    </div>
    
    </section>";


require_once "../footer.php";

?>