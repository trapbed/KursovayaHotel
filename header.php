<?php
session_start();
// include "C:\OSPanel\domains\coursework\connect\connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../css/style.css'>
    <!-- <title>LION</title> -->
    
</head>
<body>
    <div id="backgroundModal"></div>
    
    <div id="signinDiv">
        <div id="frameSignin">
            <div id="closeSignin">
                <img src="../images/x.svg" alt="exit">
            </div>
            <h1>Авторизуйтесь</h1>
            <div id="signinForm">
                <form id="signinFromSignin" action="/user/signin-db.php" method="POST">
                    <label for="login" >Логин
                        <input type="login" name="login">
                    </label>
                    <label for="pass">Пароль
                        <input type="password" name="pass">
                    </label>
                        <input id="signinBtn" type="submit" value="Войти">
                    <span id="toSignup">Еще нет аккаунта? <span id="toSignupBtn"> Зарегистрируйтесь</span></span>

                </form>
            </div>
        </div>
    </div>

    <div id="signUpDiv">
        <div id="borderSignUpDiv">
            <div id="closeSignup">
                <img src="../images/x.svg" alt="exit">
            </div>
            <h1>Зарегистрируйтесь</h1>
            <form action="/user/signup-db.php" method="post" id="signupFormSignup">
                <label for='login'>Логин<input type="text" name="login"></label>
                <label for="bday">Дата рождения<input type="date" name='bday' placeholder = 'гггг-мм-дд' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'></label>
                <label for="email">Почта<input type="mail" name='email'></label>
                <label for="pass">Пароль<input type="password" name='pass'></label>
                <input id="signUpBtn" type="submit" value="Зарегистрироваться">
            </form>
            <div id="emtySignup"></div>
            <span id="endSignup">Уже есть аккаунт? <span id='toSigninbtn'> Войдите</span></span>
        </div>
    </div>


    <nav id='headerNav'>
        <img src="../images/logo.png" alt="logo" id='logoNav'>
        <div id="headerNavSpans">
            <div id="headerNavigation">
                <a href="../">Главная</a>
                <a href="../catalog.php">Каталог</a>
                <a href="../contacts.php">Контакты</a>
                <a href="../services.php">Услуги</a>
            </div>
            <div id="sign">
                <?php

                if(isset($_SESSION['id_user'])){
                    echo "<a href='../exit.php'>Выйти</a><a id='userLogin' href='../account.php?'>".$_SESSION['login']."</a>";
                }
                else{
                    echo "<span id='signup'>Регистрация</span> <span id='signin'>Авторизация</span>";
                }

                ?>
            </div>
        </div>
    </nav>