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

    public function user_exist($login, $pass){
        $user_exist = mysqli_query($this->conn, "SELECT id_user, login, password, role FROM users WHERE login ='$login'");
        if(mysqli_num_rows($user_exist) != 0){
            $user_exist_valid = true;
            return $user_exist_valid;
        }
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

    public function signin($login, $pass){

        if($login && $pass){
            $user_exist = $this->user_exist($login, $pass);
            if($user_exist == true){
                $user = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id_user, login, password, role FROM users WHERE login ='$login' AND password= '$pass'"));
                if($user){
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['role'] = $user['role'];
                    echo $_SESSION['id_user'];
                    echo $user['role'];
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
                    echo "
                    <script>
                        alert('Неверный пароль!');
                        location.href='/';
                    </script>";
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
            if(!$login){
                $error = 'Введите логин';
            }
            if(!$pass){
                $error = 'Введите пароль ';
            }
            if(!$login && !$pass){
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

    public function signup($login, $bday, $email, $pass){
        $user_exist = $this->user_exist($login, $pass);
        $check_bday = $this->check_bday($bday);

        if(!$login || !$bday || !$email || !$pass){
            $error = "Введите данные!";
        }
        
        if($user_exist == true){
            $error = "Такой пользователь существует! Войдите в аккаунт!";
        }
        else{
            
            $insert_user = mysqli_query($this->conn,"INSERT INTO users (login, password) VALUES ('$login','$pass')");
            $id_user = mysqli_insert_id($this->conn);
            $insert_byuer = mysqli_query($this->conn,"INSERT INTO buyer (id_user ,birthday, mail) VALUES ($id_user, '$bday','$email')");
            $_SESSION['id_user'] = $id_user;
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $user['role'];
            $error = "Вы успешно зарегистрировались!";
            if($check_bday == false){
                $error .= "Вам еще нет 18! Вы не сможете забронировать номер!";
            }
        }
        echo "<script>
        alert('$error');
        location.href = '/'; 
        </script>";
    }

    public function get_info_user($id){
        
        $user_info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT 
        users.id_user, name, sname, pathronymic, birthday, phone, mail, password, login, blocked 
        FROM buyer JOIN users ON users.id_user=buyer.id_user WHERE users.id_user = ".$id));
        return $user_info;
    }

    public function get_login_pass($id){
        $user_info = mysqli_fetch_array(mysqli_query($this->conn, "SELECT login, password FROM users WHERE id_user =".$id));
        return $user_info;
    }

    public function add_info($id, $name, $sname, $path, $bday, $phone, $email){
        $check_user = $this->get_info_user($id);
        if($check_user[1] !=  $name || $check_user[2] !=  $sname || $check_user[3] != $path || $check_user[4] != $bday || $check_user[5] != $phone || $check_user[6] != $email ){
            $check_comma = false;        
            $query = "UPDATE buyer SET ";
            if($name != $check_user[1]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $query .= "name = '$name' ";
                $check_comma = true;
            }
            if($sname != $check_user[2]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= "sname = '$sname' ";
            }
            if($path != $check_user[3]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= "pathronymic = '$path' ";
            }
            if($bday != $check_user[4]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= "birthday = '$bday' ";
            }
            if($phone != $check_user[5]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= "phone = '$phone' ";
            }
            if($email != $check_user[6]){
                if($check_comma == true){
                    $query .= ", ";
                }
                $check_comma = true;
                $query .= "mail = '$email' ";
            }
            $query .= " WHERE buyer.id_user =".$id;
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

    public function changeLoginPass($id, $login, $pass){
        $check_user = $this->get_login_pass($id);
        $query = "";
        $check_comma = false;
        if($check_user[1] != $login || $check_user[2] != $pass){
            $query = "UPDATE users SET ";
            if($check_user[1] != $login ){
                if($check_comma == true){
                    $query .= " , ";
                }
                $check_comma = true;
                $query .= "login = '$login'";
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
                $_SESSION['login'] = $login;
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
}

?>