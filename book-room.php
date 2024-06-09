<?php
require_once "header.php";
if(!isset($_SESSION['id_user'])){
    $id = isset($_POST['idRoom']) ? $_POST['idRoom'] : false;
    if($id){
        $_SESSION['message'] = "Перед бронированием авторизируйтесь в системе!";
        header("Location: ../room.php?idRoom=$id");
    }
    else{
        $_SESSION['message'] = "Перед бронированием авторизируйтесь в системе!";
        header("Location: ../index.php");
    }
}

require_once "footer.php";
?>