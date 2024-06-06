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
    // 
    public function update_status_service($id, $act){
        $query = "UPDATE `service` SET `exist` =  ";
        if($act == 'delete'){
            $query .= " '0' ";
        }
        else{
            $query .= " '1' ";
        }
        $query .= " WHERE `service`.`id_service` = $id";
        echo $query;
        $query = mysqli_query($this->conn, $query);
        if($query){
            $_SESSION['message'] = "Успешное изменение статуса!";
        }
        else{
            $_SESSION['message'] = "Не удалось изменить статус услуги!";
        }
        header("Location: ../admin/index.php?page_admin=services");
    }
    // 
    public function update_status_cat_service($id, $act){
        $query = "UPDATE `cat_services` ";

        if($act == 'recover'){
            $query .= "SET `exist` = '1'";
        }
        if($act == 'delete'){
            $query .= "SET `exist` = '0'";
        }
        $query .= " WHERE `cat_services`.`id_cat_service` = $id";
        $result = mysqli_query($this->conn, $query);
        if($result){
            $_SESSION['message'] = "Статус категории услуг изменен!";
        }
        else{
            $_SESSION['message'] = "Не удалось изменить статус категории услуг!";
        }
        header("Location: ../admin/index.php?page_admin=catServices");
    }
    // 
    public function update_name_cat_serv($id, $name){
        $query = "UPDATE `cat_services` SET `name_cat_service` = '$name' WHERE `cat_services`.`id_cat_service` = $id;";
        $result = mysqli_query($this->conn, $query);
        if($result){
            $_SESSION['message'] = "Название категории успешно изменено!";
        }
        else{
            $_SESSION['message'] = "Не удалось изменить название категории!";
        }
        header("Location: ../admin/index.php?page_admin=catServices");
    }
    // 
    public function update_status_room($id, $act){
        $query = "UPDATE `rooms` SET `exist` = ";
        if($act == 'recover'){
            $query .= " '1' ";
        }
        else{
            $query .= " '0' ";
        }
        $query .= "WHERE `rooms`.`id_room` = $id";
        $result = mysqli_query($this->conn, $query);
        if($result){
            $_SESSION['message'] = "Статус успешно изменен!";
        }
        else{
            $_SESSION['message'] = "Не удалось изменить статус номера!";
        }
        header("Location: ../admin/index.php?page_admin=rooms");
    }
    public function update_room($id, $long, $short, $desc, $img, $cat, $amount){
        $query = mysqli_query($this->conn, "UPDATE `rooms` SET `long_name_room` = '$long', `short_name_room` = '$short', `desc_room` = '$desc', `img_room` = '$img', `id_cat_room` = $cat, `amount_in_hotel` = $amount WHERE `rooms`.`id_room` = $id;");
        if($query){
            $_SESSION['message'] = "Данные успешно обновлены!";
            header("Location: ../admin/index.php?page_admin=rooms");
        }
        else{
            $_SESSION['message'] = "Данные успешно обновлены!";
            header("Location: ../admin/index.php?page_admin=rooms");
        }
    }
}
?>

<!-- eckeu -->