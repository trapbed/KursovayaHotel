<?php

require_once "Connect.php";
session_start();

class Change extends Connect{
    // БЛОКИРОВКА ПОЛЬЗОВАТЕЛЯ
    public function block_user($id){
        $query = mysqli_query($this->conn, "UPDATE `users` SET `blocked` = '1' WHERE `users`.`id_user` = $id");
        if($query){
            $_SESSION['message'] = "Пользователь успешно заблокирован";
        }
        else{
            $_SESSION['message'] = "Не удалось заблокровать пользователя";
        }
    }
    // РАЗБЛОКИРОВКА ПОЛЬЗОВАТЕЛЯ
    public function unblock_user($id){
        $query = mysqli_query($this->conn, "UPDATE `users` SET `blocked` = '0' WHERE `users`.`id_user` = $id");
        if($query){
            $_SESSION['message'] = "Пользователь успешно разблокирован";
        }
        else{
            $_SESSION['message'] = "Не удалось разблокровать пользователя";
        }
    }
    // СМЕНА СТАТУСА БРОНИ
    public function change_book_status($action, $id_book){
        if($action == 'reject'){
            $act = 'отменен';
        }
        else if($action == 'completed'){
            $act = 'выполнен';
        }
        $query_change_status_book = mysqli_query($this->conn, "UPDATE `book` SET `status`='$act' WHERE id_book=$id_book;");
        if($query_change_status_book){
            $_SESSION['message'] = "Статус изменен на $act";
        }
        else{
            $_SESSION['message'] = "Не удалось изменить статус";
        }
        return;
    }
}
?>