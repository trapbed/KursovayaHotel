<?php

require_once "Admin_info.php";
session_start();

class Change extends Info{
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
    // 
    public function update_serv($id_serv, $name, $desc, $cat, $price, $img){
        $check = new Info();
        $check = $check->get_info_one_serv($id_serv);

        $query = "UPDATE `service` SET ";
        $bool = false;
        if($check[0] != $name){
            if($bool==true){
                $query .= ", ";
            }
            $query .= "name_service = '$name'";
            $bool = true;
        }
        if($check[2] != $desc){
            if($bool==true){
                $query .= ", ";
            }
            $query .= "desc_service = '$desc'";
            $bool = true;
        }
        if($check[3] != $cat){
            if($bool==true){
                $query .= ", ";
            }
            $query .= "cat_service = $cat";
            $bool = true;
        }
        if($check[4] != $img){
            if($bool==true){
                $query .= ", ";
            }
            $query .= "img_service = '$img'";
            $bool = true;
        }
        if($check[5] != $price){
            if($bool==true){
                $query .= ", ";
            }
            $query .= "price_service = '$price'";
            $bool = true;
        }
        $query .= "WHERE id_service=$id_serv";
        $result = mysqli_query($this->conn, $query);
        if($result){
            $_SESSION['message'] = "Данные обновлены!";
            move_uploaded_file($img, "img/services/".$img.")");
            header("Location:../admin/index.php?page_admin=services");
        }
        else{
            $_SESSION['message'] = "Данные актуальны!";
            header("Location:../admin/index.php?page_admin=services");
        }
    }
}
?>