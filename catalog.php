<?php
    include "header.php";
    require "C:\OSPanel\domains\coursework\database\Rooms.php";

    // if(isset($_GET['numPers']) || isset($_GET['numRooms']) || isset($_GET['cat']) || isset($_GET['priceFrom']) || isset($_GET['priceTo'])){
    //     $search = new Rooms();
    //     $search = $search->search_catalog($_GET['numPers'], $_GET['numRooms'], $_GET['cat'], $_GET['priceFrom'], $_GET['priceTo']);
    // }
    // // var_dump($_GET['numPers']);
    // // echo $query;
    // echo $search;

?>
    <div id="catalogRooms">
        <div id="sortCatalog">
            <form action="catalog.php" method="get">
                <select name="numPers" id="">
                    <option value="">кол-во гостей</option>
                    <option <?= (isset($_GET['numPers']) && $_GET['numPers'] == 1) ? "selected" : '' ?> value="1">1 гость</option>
                    <option <?= (isset($_GET['numPers']) && $_GET['numPers'] == 2) ? "selected" : '' ?> value="2">2 гостя</option>
                    <option <?= (isset($_GET['numPers']) && $_GET['numPers'] == 3) ? "selected" : '' ?> value="3">3 гостя</option>
                    <option <?= (isset($_GET['numPers']) && $_GET['numPers'] == 4) ? "selected" : '' ?> value="4">4 гостя</option>
                </select>

                <select name="numRooms" id="">
                    <option value="">кол-во комнат</option>
                    <?php
                        $roomInRoom = new Rooms();
                        $roomR = $roomInRoom->get_room_in_room();
                        foreach($roomR as $room){
                            $end = new Rooms();
                            $end = $end->get_end_pers($room[0]);
                            echo "<option value='$room[0]'";
                            if(isset($_GET['numRooms']) && $_GET['numRooms'] == $room[0]){
                                echo "selected";
                            }
                            echo ">$room[0] $end</option>";
                        }
                    ?>
                </select>


                <select name="cat" id="">
                    <option value="">категория</option>
                    <?php
                        $catRooms = new Rooms();
                        $catRooms = $catRooms->get_cat_name();
                        // print_r($catRooms);
                        foreach($catRooms as $catR){
                            echo "<option value='".$catR[0]."'";
                            if(isset($_GET['cat']) && $_GET['cat'] == $catR[0]){
                                echo "selected";
                            }
                            echo ">".$catR[1]."</option>";
                        }
                    ?>
                </select>
                <!-- ОТ -->
                <div class = 'priceSort'> от<input value='<?= (isset($_GET['priceSort']) && $_GET['priceSort'] == 1) ? $_GET['priceSort']: '' ?>' name='priceFrom' type="text" pattern='[0-9]{0,}'></div>
                <!-- ДО -->
                <div class = 'priceSort'> до<input value='<?= (isset($_GET['priceSort']) && $_GET['priceSort'] == 1) ? $_GET['priceSort']: '' ?>' name='priceTo' type="text" pattern='[0-9]{0,}'></div>
                &nbsp;
                &nbsp;
                <input id='submitSortCat' type="submit" value="">
                <a id='resetFormCatalog' href="catalog.php">Сбросить</a>
            </form>
        </div>

        <?php
        if(isset($_GET['numPers']) || isset($_GET['numRooms']) || isset($_GET['cat']) || isset($_GET['priceFrom']) || isset($_GET['priceTo'])){
            $search = new Rooms();
            $search = $search->search_catalog($_GET['numPers'], $_GET['numRooms'], $_GET['cat'], $_GET['priceFrom'], $_GET['priceTo']);
        }
        else{
            $search = new Rooms();
            $search = $search->get_rooms();
        }
        // var_dump($_GET['numPers']);
        // echo $query;
        // print_r($search);
        
        if($search){
            $allRooms = new Rooms();
            $allRooms = $allRooms->output_info($search[1]);
            // print_r($allRooms);

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
        }
        else{
            echo "<span id='noRoomsCat'>Нет номеров с таким запросом !</span>";
        }

        
        ?>
    </div>
<?php include "footer.php"; ?>