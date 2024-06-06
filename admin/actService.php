<?php

require_once "../database/Admin_info.php";
session_start();
// $id = isset($_GET['id']) ? $_GET['id'] : false ;

if(!isset($_GET['id'])){
    $_SESSION['message'] = "Нет такой услуги, которую вы хотите удалить!";
    header("Location: ../admin/index.php?page_admin=services");
}
else{
    $id = $_GET['id'];
    echo $id;
    $name_serv = new Info();
    $name_serv = $name_serv->get_info_one_service($id);
    $name_serv = $name_serv[1];
    if($_GET['act'] == 'delete'){
    ?>
        <script>
        let check = confirm('Вы действительно хотите удалить услугу?')
        if(check){
            location.href = "deleteAdmin.php?page=service&id=<?=$id?>&act=delete";
        }
        else{
            <?php $_SESSION['message'] = "Услуга $name_serv все еще существует!";?>
            location.href = "../admin/index.php?page_admin=services";
        }
        </script>
    <?php }else{?>
        <script>
        let check = confirm('Вы действительно хотите восстановить услугу:?')
        if(check){
            location.href = "deleteAdmin.php?page=service&id=<?=$id?>&act=recover";
        }
        else{
            <?php $_SESSION['message'] = "Услуга $name_serv все еще существует!";?>
            location.href = "../admin/index.php?page_admin=services";
        }
        </script>
    <?php }
    
}?>