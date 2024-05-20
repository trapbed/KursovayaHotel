<?php
session_start();
require_once "../database/Admin_change.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
if($_GET['action'] == 'block'){
    $block = new Change();
    $block = $block->block_user($id);
}
if($_GET['action'] == 'unblock'){
    $unblock = new Change();
    $unblock = $unblock->unblock_user($id);
}

header("Location: index.php");
?>