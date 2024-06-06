<?php

require_once "../database/Admin_change.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!isset($_GET['page'])){
    header("Location: ../admin/index.php");
}
else{
    $act = isset($_GET['act']) ? $_GET['act'] : false;
    if($_GET['page'] == 'service'){
        $changeServ = new Change();
        $changeServ = $changeServ->update_status_service($id, $act);
    }
    if($_GET['page'] == 'catServices'){
        $delete_cat = new Change();
        $delete_cat = $delete_cat->update_status_cat_service($_GET['id'], $_GET['act']);
    }
    if($_GET['page'] == 'rooms'){
        $change_status_room = new Change();
        $change_status_room = $change_status_room->update_status_room($id, $_GET['act']);
    }
}

?>