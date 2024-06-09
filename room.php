<?php
include "header.php";
require "C:\OSPanel\domains\coursework\database\Rooms.php";
// print_r($_POST);
$date_depart = isset($_POST['date_departure']) ? $_POST['date_departure'] : false;
$date_arrival = isset($_POST['date_arrival']) ? $_POST['date_arrival'] : false;
    

$id_room = isset($_POST['idRoom']) ? $_POST['idRoom'] : $_GET['idRoom'];
$room = new Rooms();
$room = $room->get_one_room($id_room);

$img = $room[4];
$name = $room[1];
$cat = $room[7];
$numRoom = $room[8];
$numPers = $room[9];
$price = substr($room[11], 0, -3);
$square = $room[10];
$desc = $room[3];
?>

<div id="mainOneRoom">
    <span id='nameRoom'><?=$name?></span>
    <div id='infoAboutRoom'>
        <img src="../img/rooms/<?=$img?>" alt="<?=$name?>">
        <div id="infoDivRoom">
            <span>Категория :<span><?=$cat?></span></span>
            <span>Количество комнат :<span><?=$numRoom?></span></span>
            <span>Количество гостей :<span><?=$numPers?></span></span>
            <span>Стоимость :<span><?=$price?>&nbsp; руб/ночь</span></span>
            <span>Площадь :<span><?=$square?>м<sup><small>2</small></sup></span></span>
            <form action="book-room.php" method="POST">
                <input type='hidden' value='<?=$date_arrival?>' name='date_arrival'>
                <input type='hidden' value='<?=$date_depart?>' name='date_departure'>
                <input type='hidden' value='<?=$id_room?>' name='idRoom'>
                <input id='bookRoomButton' type="submit" value="К бронированию">
            </form>
        </div>
    </div>

    <span id='descRoom'><?=$desc?></span>
    <div id='constantRoom'>
        <div class="oneConstRoom"><span class="goldCR">24  /  7</span><span class="descCR">работает стойка регистрации</span></div>
        <div class="oneConstRoom"><span class="goldCR">12  :  00</span><span class="descCR">выезд</span></div>
        <div class="oneConstRoom"><span class="goldCR">14  :  00</span><span class="descCR">заезд</span></div>
    </div>
</div>

<?php
    include "footer.php";
?>