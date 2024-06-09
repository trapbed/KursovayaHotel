<?php
session_start();
require_once "../database/Admin_change.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
if($id  == $_SESSION['id_user']){
    $_SESSION['message'] = "Вы не можете изменить свою роль или свой статус!";
}
else{
    if($_GET['action'] == 'block'){
        $block = new Change();
        $block = $block->block_user($id);
    }
    if($_GET['action'] == 'unblock'){
        $unblock = new Change();
        $unblock = $unblock->unblock_user($id);
    }
    if($_GET['action']=='toUser'){
        $toUser = new Change();
        $toUser = $toUser->change_role('user', $id);
    }
    if($_GET['action']=='toAdmin'){
        $toAdmin = new Change();
        $toAdmin = $toAdmin->change_role('admin', $id);
    }
}

header("Location: index.php");
?>