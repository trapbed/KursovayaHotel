<?php
require_once "../database/Admin_info.php";
session_start();
$act = isset($_GET['act']) ? $_GET['act'] : false;
$id = isset($_GET['id']) ? $_GET['id'] : false;
// $check_exist_room = new Info();
// $check_exist_room = $check_exist_room->get_rooms_by_cat($id);
if(!$id && !$act){
    $_SESSION['message'] = "Не удалось изменить статус номера!";
    header("Location: ../admin/index.php?page_admin=rooms");
}
else{ 
    if($act == 'delete'){ ?>
    <script>
        let check = confirm('Вы точно хотите удалить номер?');
        if(check){
            location.href = "deleteAdmin.php?page=rooms&id=<?=$id?>&act=delete";
        }
        else{
            <?php $_SESSION['message'] = "Номер все еще существует!"; ?>;
            location.href = '../admin/index.php?page_admin=rooms';
        }
    </script>
<?php }
    if($act == 'recover'){ ?>
    <script>
        let check = confirm('Вы точно хотите восстановить номер?');
        if(check){
            location.href = "deleteAdmin.php?page=rooms&id=<?=$id?>&act=recover";
        }
        else{
            <?php $_SESSION['message'] = "Номер все еще считается удаленым!"; ?>;
            location.href = '../admin/index.php?page_admin=rooms';
        }
    </script>
   <?php }
}
?>