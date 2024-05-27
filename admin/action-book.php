<?php

require_once "../database/Admin_change.php";
session_start();

$act = isset($_GET['act']) ? $_GET['act'] : false ;
$id = isset($_GET['id']) ? $_GET['id'] : false ;

$change = new Change();
$change = $change->change_book_status($act, $id);

// echo "<script>
//     location.href = 'index.php?page_admin=bookings';
// </script>";
header("Location: index.php?page_admin=bookings");
?>