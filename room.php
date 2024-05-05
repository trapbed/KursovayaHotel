<?php

include "header.php";

require "C:\OSPanel\domains\coursework\database\Rooms.php";

$id_room = $_POST['idRoom'];
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
        <img src="../images/rooms/<?=$img?>" alt="<?=$name?>">
        <div id="infoDivRoom">
            <span>Категория : &nbsp;<span><?=$cat?></span></span>
            <span>Количество комнат : &nbsp;<span><?=$numRoom?></span></span>
            <span>Количество гостей : &nbsp;<span><?=$numPers?></span></span>
            <span>Стоимость : &nbsp;<span><?=$price?>&nbsp; руб/ночь</span></span>
            <span>Площадь : &nbsp;<span><?=$square?>м<sup>2</sup></span></span>
            <form action="" method="POST">
                <input type="hidden" value="<?=$id_room?>" name="idRoom">
                <input type="submit" value="Забронировать">
            </form>
        </div>
    </div>
    <span id='descRoom'><?=$desc?></span>
    <div id='constantRoom'></div>
</div>

<?php
    include "footer.php";
?>