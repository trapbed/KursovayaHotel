<?php
if(!isset($_GET['page'])){
    echo "<script>location.href='changeAcc.php?page=account';</script>";
}
session_start();
include "header.php";
include "./database/User.php";
$user = new User();
$user = $user->get_info_user($_SESSION['id_user']);
?>
<div id="account">
    <aside id='accountNav'>
        <a <?=$_GET['page']=="account" || !$_GET['page'] ? "" : "id='noActivePageUser'" ?> href="account.php?page=account">Аккаунт</a>
        <a <?=$_GET['page']=="history" ? "" : "id='noActivePageUser'" ?> href="account.php?page=history">История</a>
    </aside>

    <div id="changeAcc">
        <div id="headerUserData"><span>Персональные данные &nbsp;&nbsp;&nbsp;</span><hr></div>
        <form action="/user/changeAcc-db.php" method="POST">
                <div id="personalData">
                    <div class="personalUserData">
                        <label>
                            Имя
                            <input type="text" name='name' placeholder='Введите имя' title='Введите имя' value='<?=$user[1]?>' required>
                        </label>
                        <label>
                            Фамилия
                            <input type="text" name='sname' placeholder='Введите фамилию' title='Введите фамилию' value='<?=$user[2]?>' required>
                        </label>
                    </div>
                    <div class="personalUserData">
                        <label>
                            Отчество
                            <input type="text" name='path' placeholder='Введите отчество' title='Введите отчество' value='<?=$user[3]?>'>
                        </label>
                        <label>
                            Дата рождения
                            <input type="date" name="bday" placeholder='Введите дату рождения' title='Введите дату рождения' value="<?=$user[4]?>" required>
                        </label>
                    </div>
                </div>
                <br><br>
                <div id="headerUserData"><span>Контактные данные &nbsp;&nbsp;&nbsp;</span><hr></div>
                <div id="contactUserData">
                    <label>
                        Телефонный номер
                        <input type="text" name='phone' placeholder='81234567890'value='<?=$user[5]?>' pattern='[0-9]{11}' title='Введите телефонный номер' required>
                    </label>
                    <label>
                        Почта
                        <input type="text" name='email' placeholder='Введите почту' title='Введите почту' value='<?=$user[6]?>' required>
                    </label>
                </div>
                <!-- <br><br> -->
                <!-- <div id="headerUserData"><span>Безопасность &nbsp;&nbsp;&nbsp;</span><hr></div> -->
                <!-- <div id="securityData">
                    <label id='passwordChange'>
                        Пароль
                        <input id='inputPass' type="password" name='pass' placeholder='Введите пароль' title='Введите пароль' value='=$user[7]?>'  required><div id='eyeOpen' class='passwordAbs'></div><div id='eyeClose' class='passwordAbs'></div>
                    </label>
                </div> -->

                <div class="empty60"></div>
                <input id='saveChangeUser' type="submit" value="Сохранить">
        </form>
    </div>
    






</div>
<?php

    include "footer.php";

?>

<script src='/js/eye.js'></script>