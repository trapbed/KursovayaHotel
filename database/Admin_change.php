<?php

require_once "Connect.php";
session_start();

class Change extends Connect{
    public function block_user($id){
        $query = mysqli_query($this->conn, "UPDATE `users` SET `blocked` = '1' WHERE `users`.`id_user` = $id");
        if($query){
            $_SESSION['message'] = "Пользователь успешно заблокирован";
        }
        else{
            $_SESSION['message'] = "Не удалось заблокровать пользователя";
        }
    }
    public function unblock_user($id){
        $query = mysqli_query($this->conn, "UPDATE `users` SET `blocked` = '0' WHERE `users`.`id_user` = $id");
        if($query){
            $_SESSION['message'] = "Пользователь успешно разблокирован";
        }
        else{
            $_SESSION['message'] = "Не удалось разблокровать пользователя";
        }
    }
}
?>