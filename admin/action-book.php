<?php

require_once "../database/Admin_change.php";
require_once "../database/Booking.php";
session_start();

$act = isset($_GET['act']) ? $_GET['act'] : false ;
$id = isset($_GET['id']) ? $_GET['id'] : false ;
$dateA = isset($_GET['dateA']) ? $_GET['dateA'] : false;
$dateD = isset($_GET['dateD']) ? $_GET['dateD'] : false;
$room = isset($_GET['room']) ? $_GET['room'] : false;
$email = isset($_GET['email']) ? $_GET['email'] : false;

if( $act == 'completed'){
    $change = new Change();
    $change = $change->change_book_status($act, $id, $email);
}
else{
    $change = new Book();
    $change = $change->delete_book($id, $dateA, $dateD,$room,$email, 'admin');
}
// echo "<script>
//     location.href = 'index.php?page_admin=bookings';
// </script>";
header("Location: index.php?page_admin=bookings");
?>