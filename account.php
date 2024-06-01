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
<span>history</span>

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
                        <td class='valueRowUser'><input id='inputPass' onclick='' type="password" name="" value='<?=$pass?>' readonly> <div id='eyeOpen'></div><div id='eyeClose'></div>&nbsp;&nbsp;&nbsp;<a href='loginPassChange.php'><img id='penChangePass' src="../img/pen.png" alt="chenge password"></a></td>
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