<?php

require_once "Admin_info.php";

    class Create extends Info{
        public function create_service($name,$desc, $cat, $price, $img){
            $check = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM service WHERE name_service='$name'"));
            if($check != 0){
                $_SESSION['message'] = "Такая услуга уже существует!";
                header("Location: createService.php");
            }
            else{
                $service = mysqli_query($this->conn, "INSERT INTO `service`(`name_service`, `desc_service`, `cat_service`, `img_service`, `price_service`) VALUES ('$name','$desc','$cat','$img',$price)");
                if($service){
                    move_uploaded_file($file['name'], "img/services/".$file['name'].")");
                    $_SESSION['message'] = "Успешное создание услуги!";
                    header("Location:../admin/index.php?page_admin=services");
                    unset($_SESSION['create_serv']);
                }
                else{
                    $_SESSION['message'] = "Не удалось создать услугу!";
                    header("Location:../admin/index.php?page_admin=services");
                }
            }
        }
        public function create_cat_service($name){
            $query = "INSERT INTO `cat_services` (`name_cat_service`) VALUES ('$name');";
            $result = mysqli_query($this->conn, $query);
            if($result){
                $_SESSION['message'] = "Категория услуг создана!";
            }
            else{
                $_SESSION['message'] = "Не удалось создать каткгорию для услуг!";
            }
            header("Location: ../admin/index.php?page_admin=catServices");
        }
        public function create_room($long_name, $short_name, $desc, $cat, $amount_rooms, $img, $tmp){
            $query = "INSERT INTO `rooms`(`long_name_room`, `short_name_room`, `desc_room`, `img_room`, `id_cat_room`, `amount_in_hotel`) VALUES ('$long_name','$short_name','$desc','$img', $cat,$amount_rooms)";
            $result = mysqli_query($this->conn, $query);
            if($result){
                $_SESSION['message'] = 'Успешное создание услуги!';
                // move_uploaded_file($tmp, "img/rooms/".$img.")");
                unset($_SESSION['create_serv']);
                unset($_SESSION['create_room']);
                header("Location: ../admin/index.php?page_admin=rooms");
            }
            else{
                $_SESSION['message'] = 'Не удалось создать услугу!';
                $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount_rooms,'img'=>$img];
                header("Location: ../admin/createRoom.php");
            }
        }
    }

?>