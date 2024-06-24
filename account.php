<?php
if(!isset($_GET['page'])){
    echo "<script>location.href='account.php?page=account';</script>";
}
session_start();

include "database/User.php";
include "./header.php";
$id_user = $_SESSION['id_user'];
$role = $_SESSION['role'];
if($role == 'admin'){
    echo "<script>
            location.href='loginPassChange.php';
        </script>
    ";
}
?>

<div id="account">
    <aside id='accountNav'>
        <a <?=$_GET['page']=="account" || !isset($_GET['page']) ? " " : "id='noActivePageUser'" ?> href="account.php?page=account">Аккаунт</a>
        <a <?=$_GET['page']=="history" ? " " : "id='noActivePageUser'" ?> href="account.php?page=history">История</a>
    </aside>
<?php if($_GET['page'] == "history"){?>
<!-- <span>history</span> -->

<div id='accountHistory'>
    <h2>История бронирований</h2>
    <div id='scrollAccauntHistory'>
        <?php
            $bookings = new User();
            $bookings = $bookings->get_info_user_books($id_user);
            $bookings_arr = $bookings['array'];
            foreach($bookings_arr as $book){

                switch($book[5]){
                    case 'принят':
                        $color = 'black';
                        break;
                    case 'выполнен':
                        $color = 'green';
                        break;
                    case 'отменен':
                        $color = 'red';
                        break;
                }
                $dateArrival = substr($book[3],8,2)."-".substr($book[3],5,2)."-".substr($book[3],0,4);
                $dateDeparture = substr($book[4],8,2)."-".substr($book[4],5,2)."-".substr($book[4],0,4);
                $img_book = false;
                $tag_start = false;
                $tag_end = false;
                echo "<div class='userBookCart'>
                    <h4>Бронь №  ".$book[0]."</h4>
                    <div class='bookCartInfoRoom'>
                        <div class='bookNameDel'>
                            <div><span>Название:</span> <p>".$book[6]."</p></div>";
                            $interval = (abs(strtotime(date('Y-m-d'))-strtotime(date($book[3]))))/(24*60*60);
                            if($book[5] == 'принят' && $interval<=3){
                                $img_book = "../img/account/schedule.png";
                                $tag_start = "<div class='statusBlockBook' title='Номер забронирован, отменить бронь нельзя!'>";
                                $tag_end = "</div>";
                                $book[5] .= ' (Без отмены)';
                            }
                            else if($book[5] == "принят"){
                                $img_book = "../img/account/delete.png";
                                $tag_start = "<a href='../user/book_pre_delete.php?id_book=$book[0]&dateA=$book[3]&dateD=$book[4]&room=$book[2]'>";
                                $tag_end = "</a>";
                            }
                            else if($book[5] == "отменен"){
                                $img_book ="../img/account/broken.png";
                                $tag_start = "<div class='statusBlockBook'>";
                                $tag_end = "</div>";
                            }
                            else{
                                $img_book = "../img/account/check.png";
                                $tag_start = "<div class='statusBlockBook'>";
                                $tag_end = "</div>";
                            }
                            echo $tag_start."<img src='".$img_book."' alt='deleteBook'>".$tag_end."</div>
                        <div class='datesStatusPersBook'>
                            <div class='bookColumnDate'><span>Дата заезда:</span> <p>".$dateArrival."</p></div>
                            <div class='bookColumnDate'><span>Дата выезда:</span> <p>".$dateDeparture."</p></div>
                            <div class='personRoomHistory'><img src='../img/account/user.png' alt='user'>".$book[12]."</div>
                            <div class='status$color'><span>Статус:</span> <p>".$book[5]."</p></div>
                            <form method='POST' action='info_book_room.php' class='bookForm'>
                                <input type='hidden' name='dateA' value='".$dateArrival."'>
                                <input type='hidden' name='dateD' value='".$dateDeparture."'>
                                <input type='hidden' name='id_book' value='".$book[0]."'>
                                <input type='hidden' name='id_room' value='".$book[2]."'>
                                <input type='submit' value='Подробнее'>
                            </form>
                        </div>
                    </div>
                </div>";
            }
        ?>
    </div>
</div>

<?php }else{ ?>
    <div id="infoAcc">
        <?php
            $user = new User();
            $user = $user->get_info_user($id_user);
        ?>
        <div id='allInfoUser'>
            <?php 
                if(!isset($user[1]) && !isset($user[2]) && !isset($user[3])){
                    $name = "<a href='changeAcc.php' class='noDataUser'>Заполните ФИО</a>";
                }
                else {
                    $name = $user[2]."&nbsp;".$user[1]."&nbsp;".$user[3];
                }
                if(isset($user[4])){
                    $bday = $user[4];
                    $date = substr($bday, 8, 2);
                    $month = substr($bday, 5, 2);
                    $year = substr($bday, 0, 4);
                    $bday = $date."/".$month."/".$year;
                }else{
                    $bday = "<a href='changeAcc.php' class='noDataUser'>Заполните дату рождения</a>";
                }
                
                $phone = isset($user[5]) ? $user[5] : "<a href='changeAcc.php'  class='noDataUser'>Заполните данные о телефоне</a>";
                $email = isset($user[6]) ? $user[6] : "<a href='changeAcc.php'  class='noDataUser'>Заполните данные о почте</a>";
                $pass = $user[7];
            ?>
            <h1 id='nameSnmae'><?=$name?></h1>
                <table>
                    <tr class='trInfoUser'>
                        <td class='nameRowUser'>Дата рождения</td>
                        <td class='valueRowUser'><?=$bday?></td>
                    </tr>
                    <tr class='trInfoUser'>
                        <td class='nameRowUser'>Телефонный номер</td>
                        <td class='valueRowUser'><?=$phone?></td>
                    </tr>
                    <tr class='trInfoUser'>
                        <td class='nameRowUser'>Почта</td>
                        <td class='valueRowUser'><?=$email?></td>
                    </tr>
                    <tr class='trInfoUser'>
                        <td class='nameRowUser'>Пароль</td>
                        <td class='valueRowUser'><input id='inputPass' type="password" name="" value='<?=$pass?>' readonly> <div id='eyeOpen'></div><div id='eyeClose'></div>&nbsp;&nbsp;&nbsp;<a href='loginPassChange.php'><img id='penChangePass' src="../img/pen.png" alt="chenge password"></a></td>
                    </tr>
                    <tr class='trInfoUser'>
                        <td class='nameRowUser'>
                            <form action="changeAcc.php" method ='POST'>
                                <input id="toChangeAcc" type="submit" value="Изменить данные профиля">
                            </form>
                        </td>
                        <td class='valueRowUser'></td>
                    </tr>
                </table>
        </div>
        <!-- <a id='changeLP' href="loginPassChange.php">Изменить логин и пароль</a> -->
    </div>
    <?}?>
</div>

<?php

include "./footer.php";

?>
<script src='/js/eye.js'></script>