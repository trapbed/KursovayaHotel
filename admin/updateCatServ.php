<?php
require_once "../header.php";
require_once "../database/Admin_info.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
$name = new Info();
$name = $name->get_info_one_cat_serv($id);
$name = $name['array'][1];

// print_r($saved);
    echo "<section class='changeAdminDiv'>
    <h4>Редактирование категории услуги</h4>
    <div id='formNOldImg'>
        <form action='changeAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='updateCatServ'>
            <input type='hidden' name='id' value='$id'>
            <label for='name' class='labelAdminChange'>
                Название категории услуги
                <input type='text' name='name' value='$name'>
            </label>
            <input type='submit' value='Сохранить'>
        </form>
    </div>
    
    </section>";


require_once "../footer.php";

?>