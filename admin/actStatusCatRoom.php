<?php
require_once "../database/Admin_change.php";
session_start();

$id_cat_room = isset($_GET['id']) ? $_GET['id'] : false;
$act = isset($_GET['act']) ? $_GET['act'] : false;

$check_exist = new Info();
$check_exist = $check_exist->check_exist_room_with_cat($id_cat_room);

echo $check_exist;

if($check_exist > 0){
    $_SESSION['message'] = "Пока есть товары этой категории Вы не можете удалить категорию!";
    echo "<script>
        location.href = '../admin/index.php?page_admin=catRooms';
    </script>";
}
else{
    if($id_cat_room){
        $change_status_cat_room = new Change();
        $change_status_cat_room = $change_status_cat_room->change_status_cat_room($id_cat_room, $act);
    }
    else{
        echo "<script>
            location.href = '../admin/index.php?page_admin=catRooms';
        </script>";
    }
}

?>