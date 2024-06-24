<?php
    require_once "../database/Booking.php";
    $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] != "" : false;
    $dateA = isset($_GET['dateA']) && $_GET['dateA'] != "" ? $_GET['dateA'] : false;
    $dateD = isset($_GET['dateD']) && $_GET['dateD'] != "" ? $_GET['dateD'] : false;
    $room = isset($_GET['room']) && $_GET['room'] != "" ? $_GET['room'] : false;
    $email = $_SESSION['email'];
    $delete_book = new Book();
    $delete_book = $delete_book->delete_book($id, $dateA, $dateD, $room, $email, 'user');
?>