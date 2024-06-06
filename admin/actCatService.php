<?php

require_once "../database/Admin_info.php";
session_start();

$act = isset($_GET['act']) ? $_GET['act'] : false;
$id = isset($_GET['id']) ? $_GET['id'] : false;
$check_exist_serv = new Info();
$check_exist_serv = $check_exist_serv->get_serv_by_cat($id);
$check_exist_serv = $check_exist_serv['num_row'];

if($check_exist_serv != 0){
    echo "
    <script>
        alert('Вы не можете удалить категорию пока в ней есть услуги. Сначала удалите услуги!');
        location.href = '../admin/index.php?page_admin=catServices';
    </script>
    ";
}
else{
    if($act == 'delete'){?>
    <script>
        let check = confirm('Вы действительно хотите удалить категорию?');
        if(check){
            location.href="deleteAdmin.php?page=catServices&id=<?=$id?>&act=delete";
        }
        else{
            <?php $_SESSION['message'] = "Категория услуги все еще существует!";?>
            location.href='../admin/index.php?page_admin=catServices';
        }
    </script>
    <?php }
    if($act == 'recover'){ ?>
    <script>
        let check_recover = confirm('Вы действительно хотите восстановить категорию услуг?');
        if(check_recover){
            location.href="deleteAdmin.php?page=catServices&id=<?=$id?>&act=recover";
        }
        else{
            <?php $_SESSION['message'] = "Категория услуг все еще удалена!"; ?>
            location.href = "../admin/index.php?page_admin=catServices";
        }
    </script>
    <?php }
    }

?>