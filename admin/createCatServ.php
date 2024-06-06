<?php
require_once "../header.php";
// require_once "../database/Admin_info.php";
// $exist = new Info();
// $exist = $exist->get_info_cat_serv_by_id($name);

require_once "../database/Admin_info.php";
// $saved = isset($_SESSION['create_serv']) ? $_SESSION['create_serv'] : false;
// $name =  ($saved != false) ? $saved['name'] : false;


// print_r($saved);
    echo "<section class='changeAdminDiv'>
    <h4>Создание категории услуги</h4>
    <div id='formNOldImg'>
        <form action='createAdmin.php' method='POST' id='changeServAdmin' enctype='multipart/form-data'>
            <input type='hidden' name='act' value='catService'>
            <label for='name' class='labelAdminChange'>
                Название категории услуги
                <input type='text' name='name' value=''>
            </label>
            <input type='submit' value='Создать'>
        </form>
    </div>
    
    </section>";


require_once "../footer.php";

?>