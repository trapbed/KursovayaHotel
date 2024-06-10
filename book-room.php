<?php
require_once "header.php";
require_once "database\User.php";
require_once "database\Rooms.php";

if($_SESSION['role'] == 'admin'){
    $_SESSION['message'] = "Администратор не может забронировать номер!";
    echo "<script>
        location.href='../catalog.php';
    </script>";
}
else{

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
    else{
        $info_user = new User();
        $info_user = $info_user->get_info_user($_SESSION['id_user']);
        
        $info_room = new Rooms();
        $info_room =$info_room->get_one_room($_POST['idRoom']);


        $date_departure = $_POST['date_departure'] != "" ? $_POST['date_departure'] : false ;
        $date_arrival =   $_POST['date_arrival'] != "" ? $_POST['date_arrival'] : false ;

        $id = isset($_POST['idRoom']) ? $_POST['idRoom'] : false;
        if($date_arrival == false || $date_departure == false){
            $_SESSION['message'] = "Выберите даты заезда и выезда!";
            header("Location: ../catalog.php");
        }
        if($info_user[1] == "" || $info_user[2] == "" || $info_user[3] =="" || $info_user[6] == "" ||  $info_user[5] == ""){
            $_SESSION['message'] = "Заполните профиль перед бронированием!";
            header("Location: ../room.php?idRoom=$id");
        }else{
            $date_arrival_format = strtotime($date_arrival);
            $date_arrival_format = date('d-m-Y', $date_arrival_format);

            $date_departure_format = strtotime($date_departure);
            $date_departure_format = date('d-m-Y', $date_departure_format);

            $days_of_stay = strtotime($date_departure)-strtotime($date_arrival) ;
            $days_of_stay = $days_of_stay/60/60/24;

            $sum_book = $days_of_stay*$info_room[11];

            echo "<section id='bookRoom'>
            <h4>Бронирование номера</h4>
            <div id='bookInfoRoom'>
                <span id='bookNameRoom'>$info_room[1]</span>
                <div id='bookContentRoom'>
                    <div id='intoBookContentRoom'>
                        <div id='bookDates'> 
                            <span>Дата заезда: ".$date_arrival_format."</span>
                            <span>Дата выезда: ".$date_departure_format."</span>
                        </div>
                        <div id='bookContentInfoRoom'> 
                            <span> Категория номера:".$info_room[5]."</span>
                            <span> Количество гостей:".$info_room[9]."</span>
                            <span> Количество комнат:".$info_room[8]."</span>
                        </div>
                        <div id='bookInfoPrice'>
                            <span>Цена: ".$info_room[11]."&#8381;</span>
                            <span>Дней проживания: ".$days_of_stay."</span>
                            <span>Сумма: <span id='bookInfoSum'>".$sum_book." &#8381;</span></span>

                        </div>
                    </div>
                    <hr>
                    <img src='../img/rooms/$info_room[4]' alt='$info_room[1]'>
                </div>
            </div>
            <div id='userInfoRoom'>
                <div id='bookUserName'>
                    <span>".$info_user[1]."</span>
                    <span>".$info_user[2]."</span>
                    <span>".$info_user[3]."</span>
                </div>
                <div id='bookUserInfoEmailPhone'>
                    <span>Адрес эл. почты: $info_user[6]</span>
                    <span>Телефонный номер: $info_user[5]</span>
                </div>
            </div>
            <form method='POST' action='../user/book.php' id='bookForm'>
                <input type='hidden' name='sum_book' value='".$sum_book."'>
                <input type='hidden' name='dateArrival' value='".$date_arrival."'>
                <input type='hidden' name='dateDeparture' value='".$date_departure."'>
                <input type='hidden' name='idUser' value='".$info_user[0]."'>
                <input type='hidden' name='idRoom' value='".$_POST['idRoom']."'>
                <input type='submit' id='submitToBook' value='Забронировать'>
            </form>
            </section>";
        }
    }
}

require_once "footer.php";
?>