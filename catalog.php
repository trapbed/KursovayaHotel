<?php
    include "header.php";
    require "C:\OSPanel\domains\coursework\database\Rooms.php";
?>
    <div id="catalogRooms">
        <div id="sortCatalog">
            <form action="" method="get">
                <select name="" id="">
                    <option value="1">1 гость</option>
                    <option value="2">2 гостя</option>
                    <option value="3">3 гостя</option>
                    <option value="4">4 гостя</option>
                </select>

                <select name="" id="">
                    <?php
                        $roomInRoom = new Rooms();
                        $roomR = $roomInRoom->get_room_in_room();
                        foreach($roomR as $room){
                            $end = new Rooms();
                            $end = $end->get_end_pers($room[0]);
                            echo "<option value='$room[0]'>$room[0] $end</option>";
                        }
                    ?>
                </select>


                <select name="" id="">
                    <?php
                        $catRooms = new Rooms();
                        $catRooms = $catRooms->get_cat_name();
                        foreach($catRooms as $catR){
                            echo "<option value='$catR[0]'>$catR[1]</option>";
                        }
                    ?>
                </select>
                <!-- ОТ -->
                <div class = 'priceSort'> от<input type="text" pattern='[0-9]{0,}'></div>
                <!-- ДО -->
                <div class = 'priceSort'> до<input type="text" pattern='[0-9]{0,}'></div>
                &nbsp;
                &nbsp;
                <input id='submitSortCat' type="submit" value="">
            </form>
        </div>

        <?php
        $allRooms = new Rooms();
        $allRooms = $allRooms->get_rooms();

        foreach($allRooms as $room){
            $price = substr($room[11], 0, -3);
        echo "<div class='oneRoomCatalog'>
                <img src='../images/rooms/$room[4]' alt='$room[1]'>
                <div class='textRoom' >
                    <h6 class='nameRoom'>$room[1]</h6>
                    <div class='aboutRoomCenter'>
                        <span class='person'>Количество гостей : &nbsp; <span class='goldenAccent'>$room[9]</span></span>
                        <span class='category'>Категория : &nbsp; <span class='goldenAccent'>$room[7]</span></span>
                        <span class='square'>Площадь : &nbsp; <span class='goldenAccent'>$room[10]м<sup>2</sup></span></span>
                    </div>
                    <textarea class='descRoomCatalog'  readonly>$room[3]</textarea>
                    <div class='priceNFormCatalog'>
                        <span>$price руб/ночь</span>
                        <form action='room.php' method='post'>
                            <input type='hidden' value='$room[0]' name='idRoom'>
                            <input type='submit' value='выбрать дату'>
                        </form>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
<?php include "footer.php"; ?>