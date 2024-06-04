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
                    move_uploaded_file($img, "img/services/".$img.")");
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
    }

?>