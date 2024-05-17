<?php
session_start();
include "header.php";
include "./database/User.php";
?>

<h1 id='titleChangeLP'>Смена логина и пароля</h1>
<div class="empty26"></div>
<?php

    $user = new User();
    $user = $user->get_email_pass($_SESSION['id_user']);

?>
<form id='changeLPform' action="/user/loginPassChange-db.php" method="post">
    <label for='login'>Логин
        <input class='LPInput' type="text" name='email' value='<?=isset($user[0]) ? $user[0] : " "?>'>
    </label>
    <label for='pass' id='passwordChange'>Пароль
        <input id='inputPass' class='LPInput' type="password" name='pass' value='<?=isset($user[1]) ? $user[1] : ""?>'><div id='eyeOpen' class='passwordAbs'></div><div id='eyeClose' class='passwordAbs'></div>
    </label>
    <div>
        <input type="submit" value="Сохранить">
    </div>
</form>

<script src='/js/eye.js'></script>