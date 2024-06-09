<?php
require_once "../database/Booking.php";

$dateArrival = isset($_POST['dateArrival']) ? $_POST['dateArrival'] : false;
$dateDepart =  isset($_POST['dateDeparture']) ? $_POST['dateDeparture'] : false;
$idRoom = isset($_POST['idRoom']) ? $_POST['idRoom'] : false;
$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : false;

if(!isset($dateArrival) || !isset($dateDepart ) || !isset($idRoom)||!isset($idUser)){
   $_SESSION['message'] = 'Что-то пошло не так, попробуйте снова!'; 
   header("Location: ../catalog.php");
}
else{
    $book = new Book();
    $book = $book->new_book($dateArrival, $dateDepart, $idRoom, $idUser);
    
    $conn = mysqli_connect("localhost","root","","lion");
    $occupied_rooms = mysqli_fetch_all(mysqli_query($conn, "SELECT date, book FROM occupied_rooms WHERE date>=$dateArrival AND date<=$dateDepart"));
    if(!$occupied_rooms){
        $insert_date = $dateArrival;
        while($insert_date <=$dateArrival){

        }
        $create_date = "";
    }
    print_r($occupied_rooms);
    foreach($occupied_rooms as $date){
        print_r($date);
        // print_r($room);
    }
}

// print_r($_POST);
?>