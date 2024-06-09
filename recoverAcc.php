<?php

require_once "header.php";

echo "<section class='changeAdminDiv'>
    <h4>Восстановление аккаунта</h4>
    <div id='formNOldImg'>
        <form action='../user/recoverAcc.php' method='POST' id='changeServAdmin'>
            <label for='email' class='labelAdminChange'>
                Введите почту
                <input type='email' name='email' value='' required>
            </label>
            <input type='submit' value='Отправить'>
        </form>
    </div>
    <span>*Мы отправим Вам письмо на почту с временным паролем. Если письмо не пришло проверьте папку со спамом</span>
    
    </section>";
?>