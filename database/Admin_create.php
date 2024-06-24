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
                $service = mysqli_query($this->conn, "INSERT INTO `service`(`name_service`, `desc_service`, `cat_service`, `img_service`, `price_service`) VALUES ('$name','$desc','$cat','".$img['name']."',$price)");
                if($service){
                    move_uploaded_file($img['tmp_name'], "C:/OSPanel/domains/coursework/img/services/".$img['name']);
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
                header("Location : ../admin/index.php");
            }
            else{
                $_SESSION['message'] = "Не удалось создать каткгорию для услуг!";
                header("Location: ../admin/index.php");
            }
        }
        public function create_room($long_name, $short_name, $desc, $cat, $amount_rooms, $img){
            $img = $img['img'];
            // print_r($img);
            // echo $img['tmp_name']."<br>", "C:/OSPanel/domains/coursework/img/rooms/".$img['name'];
            $query = "INSERT INTO `rooms`(`long_name_room`, `short_name_room`, `desc_room`, `img_room`, `id_cat_room`, `amount_in_hotel`) VALUES ('$long_name','$short_name','$desc','".$img['name']."', $cat,$amount_rooms)";
            $result = mysqli_query($this->conn, $query);
            if($result){
                $_SESSION['message'] = 'Успешное создание номера!';
                move_uploaded_file($img['tmp_name'], "C:/OSPanel/domains/coursework/img/rooms/".$img['name']);
                unset($_SESSION['create_serv']);
                unset($_SESSION['create_room']);
                header("Location: ../admin/index.php?page_admin=rooms");
            }
            else{
                $_SESSION['message'] = 'Не удалось создать номер!';
                $_SESSION['create_room'] = ['long_name'=>$long_name,'short_name'=>$short_name,'desc'=>$desc,'cat'=>$cat,'amount_rooms'=>$amount_rooms,'img'=>$img];
                header("Location: ../admin/createRoom.php");
            }
        }
        public function create_cat_room($name, $square, $max, $amount_room_in_room, $price, $count){
            if($max == 1){
                $num_pers = '1';
            }
            else{
                $num_pers = "";
                while($count < $max){
                    $count++;
                    $num_pers .= " $count" ;
                    if($count<$max){
                        $num_pers .= ", ";
                    }
                    
                }
            }
            // echo "INSERT INTO `cat_rooms` (`name_cat_room`, `amount_room_in_room`, `number_pers`, `max_pers`, `square_cat_room`, `price_cat_room`) VALUES ('$name', $amount_room_in_room, '$num_pers', $max, $square, '$price';";
            $create = mysqli_query($this->conn, "INSERT INTO `cat_rooms` (`name_cat_room`, `amount_room_in_room`, `number_pers`, `max_pers`, `square_cat_room`, `price_cat_room`) VALUES ('$name', $amount_room_in_room, '$num_pers', $max, $square, '$price')");
            if($create){
                $_SESSION['message'] = "Категория для номера создана!";
                echo "<script>
                    location.href = '../admin/index.php?page_admin=catRooms';
                </script>";
            }
            else{
                $_SESSION['message'] = "Не удалось создать категорию!";
                echo "<script>
                    location.href = '../admin/index.php?page_admin=catRooms';
                </script>";
            }
            unset($_SESSION['create_cat_room']);
        }
    }

?>