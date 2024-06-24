<?php
    session_start();
    include "header.php";
    require_once "database\User.php";
    require_once "database\Rooms.php";

    $id_user = $_SESSION['id_user'];
    $id_book = $_POST['id_book'] ;
    $id_room = $_POST['id_room'];
    $date_arrival_format = $_POST['dateA'];
    $date_departure_format = $_POST['dateD'];
    
    $info_room = new Rooms();
    $info_room =$info_room->get_one_room($id_room);
    
    $info_user = new User();
    $info_user = $info_user->get_info_user($_SESSION['id_user']);

    $days_of_stay = strtotime($date_departure_format)-strtotime($date_arrival_format) ;
    $days_of_stay = $days_of_stay/60/60/24;
    $sum_book = $days_of_stay*$info_room[11];


    // [id_book] => 17 [id_room] => 2 )
    echo "<section id='bookRoom'>
            <h4>Бронь №$id_book</h4>
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
            <div id='goToAccFromInfoOeRoom'>
                <a href='../account.php?page=history'>Вернуться назад</a>
            </div>
            </section>";
            include "footer.php";
?>