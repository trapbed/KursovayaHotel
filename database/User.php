<?php
session_start();
require "Connect.php";
class User extends Connect {
    protected $id;
    protected $login;
    protected $pass;
    protected $name;
    protected $sanme;
    protected $path;
    protected $bday;
    protected $phone;
    protected $mail;
    protected $status;
    protected $role;

    private $user_exist_valid = false;
    protected $adult;

    public function user_exist($email, $pass){
        $user_exist_valid = false;
        $user_exist = mysqli_query($this->conn, "SELECT id_user, email, password, role FROM users WHERE email ='$email'");
        if(mysqli_num_rows($user_exist) != 0){
            $user_exist_valid = true;
        }
        return $user_exist_valid;
    }

    public function check_bday($bday){
        $today = strtotime(date('Y-m-d'));
        $bday = strtotime($bday);
        $diff = $today - $bday;
        $years = floor($diff/ (365*24*60*60));
        $adult = false;
        if($years>=18){
            $adult = true;
        }
        $_SESSION['adult'] = $adult;
        return $adult;
    }

    public function signin($pass, $email){

        if($email && $pass ){
            $user_exist = $this->user_exist($email, $pass);
            if($user_exist == true){
                $user = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id_user, email, password, role, blocked FROM users WHERE email ='$email'"));
                print_r($user);
                if($user[4] == 1){
                    $_SESSION['message'] = "Вы заблокированны и не можете войти в аккаунт";
                    header("Location: ../index.php");
                }
                else{
                    $user = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id_user, email, password, role, blocked FROM users WHERE email ='$email' AND password = '$pass'"));
                    if($user){
                        $_SESSION['id_user'] = $user['id_user'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
                        echo "<script>
                            alert('Вы успешно зашли в свой аккаунт!');";
                        if($user['role']== 'user'){
                            echo "location.href = '/account.php'";
                        }
                        else{
                            echo "location.href = '/admin/index.php'";
                        }
                        echo "</script>";
                    }
                    else{
                        if(!isset($_SESSION['check_no_success'])){
                            $check_no_success = 0;
                        }
                        else{
                            $check_no_success = 1;
                        }
                        $_SESSION['check_no_success'] = $check_no_success;
                        echo "
                        <script>
                            alert('Неверный пароль!');
                            location.href='/';
                        </script>";
                    }
                }
            }
            else {
                echo "
                <script>
                    alert('Такого пользователя не существует!');
                    location.href='/';
                </script>
                ";
            }
            // print_r($user_exist);

        }
        else{
            if(!$email || $email == ""){
                $error = 'Введите логин';
            }
            if(!$pass || $pass == ""){
                $error = 'Введите пароль ';
            }
            if((!$email || $email != "") && (!$pass || $pass != "" )){
                $error = 'Введите данные';
            }
            echo "
            <script>
            alert('$error!');
            location.href = '/';
            </script>
            ";
        }
    }

    public function signup( $email,$bday, $pass){
        $user_exist = $this->user_exist($email, $pass);
        $check_bday = $this->check_bday($bday);
        
        
            $today =date('Y-m-d');
            $res = strtotime($today)-strtotime($bday);
            $res = $res/31536000;
            
            if($res > 0 ){
                if($user_exist == true){
                    $error = "Такой пользователь существует! Войдите в аккаунт!";
                }
                else{
                    $insert_user = mysqli_query($this->conn,"INSERT INTO users (email, password) VALUES ('$email','$pass')");
                    $id_user = mysqli_insert_id($this->conn);
                    $insert_byuer = mysqli_query($this->conn,"INSERT INTO buyer (id_user ,birthday) VALUES ($id_user, '$bday')");
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['email'] = $email;
                    $_SESSION['role'] = 'user';
                    $error = "Вы успешно зарегистрировались!";
                    if($check_bday == false){
                        $error .= "Вам еще нет 18! Вы не сможете забронировать номер!";
                    }
                }
            }
            else{
                $error = "Вы слишком молоды чтобы пользоваться нашей системой!";
            }

        
        
        echo "<script>
        alert('$error');
        location.href = '/'; 
        </script>";
    }

    public function get_info_user($id){
        
        $user_info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT 
        users.id_user, name, sname, pathronymic, birthday, phone, email, password, blocked 
        FROM buyer JOIN users ON users.id_user=buyer.id_user WHERE users.id_user = ".$id));
        
        return $user_info;
    }

    public function get_email_pass($id){
        $user_info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT email, password FROM users WHERE id_user =".$id));
        return $user_info;
    }

    public function add_info($id, $name, $sname, $path, $bday, $phone){
        $check_user = $this->get_info_user($id);
        if($check_user[1] !=  $name || $check_user[2] !=  $sname || $check_user[3] != $path || $check_user[4] != $bday || $check_user[5] != $phone ){
            $check_comma = false;        
            $query = "UPDATE buyer SET ";
            if($name != $check_user[1]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $query .= " name = '$name' ";
                $check_comma = true;
            }
            if($sname != $check_user[2]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= " sname = '$sname' ";
            }
            if($path != $check_user[3]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= " pathronymic = '$path' ";
            }
            if($bday != $check_user[4]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= " birthday = '$bday' ";
            }
            if($phone != $check_user[5]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= " phone = '$phone' ";
            }
            $query .= " WHERE buyer.id_user =".$id;
            print_r($query);
            $query = mysqli_query($this->conn, $query);
            if($query){
                echo "
                <script>
                    alert('Данные успешно обновлены!');
                    location.href='../account.php';
                </script>
            //     ";
            }
            else{
                echo "
                <script>
                    alert('Данные успешно обновлены!');
                    location.href='../account.php';
                </script>
                ";
            }
        }else{
            echo "
                <script>
                    alert('Данные актуальны!');
                    location.href='../account.php';
                </script>
                ";
        }
        
        // return [
        //     // $check_user[8],$login, $check_user[7], $pass
        //     $query
        // ];
        
    }

    public function changeLoginPass($id, $email, $pass){
        $check_user = $this->get_email_pass($id);
        $query = "";
        $check_comma = false;
        if($check_user[1] != $email || $check_user[2] != $pass){
            $query = "UPDATE users SET ";
            if($check_user[1] != $email ){
                if($check_comma == true){
                    $query .= " , ";
                }
                $check_comma = true;
                $query .= "email = '$email'";
            }
            if($check_user[2] != $pass){
                if($check_comma == true){
                    $query .= " , ";
                }
                $check_comma = true;
                $query .= "password = '$pass'";
            }
            $query .= " WHERE users.id_user =".$id;
            $query = mysqli_query($this->conn, $query);
            if($query){
                $_SESSION['email'] = $email;
                echo "
                <script>
                    alert('Данные обновлены!');
                    location.href='../account.php';
                </script>
                ";
            }
            else{
                echo "
                <script>
                    alert('Данные не обновлены!');
                    location.href='../account.php';
                </script>
                ";
            }
        }
        else{
            echo "
            <script>
                alert('Данные актуальны!');
                location.href='../account.php';
            </script>
            ";
        }
    }

    public function user_exist_email($email){
        $res = false;
        $query = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM users WHERE email='$email'"));
        if($query>0){
            $res = true;
        }
        return $res;
    }

    public function recoverAcc($email, $pass){
        $query = mysqli_query($this->conn, "UPDATE `users` SET `password` = '$pass' WHERE `users`.`email` = '$email';");
        if($query){
            $_SESSION['message'] = "Сообщение отправлено!";
            echo "<script>
                location.href=../index.php';
            </script>";
        }
        else{
            $_SESSION['message'] = "Не удалось отправить сообщение!";
            echo "<script>
                location.href='../index.php';
            </script>";
        }
    }

    public function get_info_user_books($id_user){
        $sql = "SELECT `id_book`, `id_user`, book.`id_room`, `date_arrival`, `date_departure`, `status`, `long_name_room`, `short_name_room`, `desc_room`, `img_room`, `name_cat_room`, `amount_in_hotel`, cat_rooms.max_pers FROM `book` JOIN rooms ON book.id_room = rooms.id_room JOIN cat_rooms ON cat_rooms.id_cat_room=rooms.id_cat_room WHERE id_user = $id_user";
        $num_row = mysqli_num_rows(mysqli_query($this->conn, $sql));
        $array = mysqli_fetch_all(mysqli_query($this->conn, $sql));
        return [
            'num_row'=>$num_row,
            'array'=>$array
        ];
    }
    // public function get_info_one_book(){

    // }
}

?>