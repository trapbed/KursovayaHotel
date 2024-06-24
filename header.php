<?php
session_start();
// include "C:\OSPanel\domains\coursework\connect\connection.php";
// echo substr($_SERVER['REQUEST_URI'], 0, 6);
if(isset($_SESSION['message'])){
    echo "<script>
        alert('".$_SESSION['message']."');
        location.href='';
    </script>";
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../css/style.css'>
    <!-- <title>LION</title> -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    
</head>
<body>
    <div id="backgroundModal"></div>
    
    <div id="signinDiv">
        <div id="frameSignin">
            <div id="closeSignin">
                <img src="../img/x.svg" alt="exit">
            </div>
            <h1>Авторизуйтесь</h1>
            <div id="signinForm">
                <form id="signinFromSignin" action="/user/signin-db.php" method="POST">
                    <label for="email" >Почта
                        <input type="email" name="email">
                    </label>
                    <label for="pass">Пароль
                        <input type="password" name="pass">
                    </label>
                        <input id="signinBtn" type="submit" value="Войти">
                    <?php if(isset($_SESSION['check_no_success'])){
                            echo "<a id='recoverInModalAcc' href='../recoverAcc.php'>Восстановить аккаунт</a>";
                            unset($_SESSION["check_no_success"]);
                        }

                    ?>
                    <span id="toSignup">Еще нет аккаунта? <span id="toSignupBtn"> Зарегистрируйтесь</span></span>

                </form>
            </div>
        </div>
    </div>

    <div id="signUpDiv">
        <div id="borderSignUpDiv">
            <div id="closeSignup">
                <img src="../img/x.svg" alt="exit">
            </div>
            <h1>Зарегистрируйтесь</h1>
            <form action="/user/signup-db.php" method="post" id="signupFormSignup">
                <label for="email">Почта<input type="mail" name='email'></label>
                <label for="pass">Пароль<input type="password" name='pass'></label>
                <label id='dateInput' for="bday">Дата рождения<input type="date" name='bday' placeholder = 'гггг-мм-дд' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'></label>
                <input id="signUpBtn" type="submit" value="Зарегистрироваться">
            </form>
            <div id="emtySignup"></div>
            <span id="endSignup">Уже есть аккаунт? <span id='toSigninbtn'> Войдите</span></span>
        </div>
    </div>
    <!-- <a href='../admin/index.php'>Админ панель</a> -->

    <?php
    if(isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin' && substr($_SERVER['REQUEST_URI'], 0,6) == '/admin'){
        echo"
            <nav id='headerNav'>
            <a href='../index.php'><img src='../img/logo.png' alt='logo' id='logoNav'></a>
            <div id='headerNavSpans'>
                <div id='headerNavigationAdmin'>
                    <a href='../admin/index.php?page_admin=users' class='";
                    if (isset($_GET['page_admin']) && $_GET['page_admin']=='users'){
                        echo "activeNavbar'";
                    }
                    else{
                        echo "inactiveNavbar'";
                    } 
                    echo ">Пользователи</a>
                    <a href='../admin/index.php?page_admin=bookings' class='";
                    if(isset($_GET['page_admin']) && $_GET['page_admin']=='bookings'){
                        echo "activeNavbar'";
                    } else{
                        echo "inactiveNavbar'";
                    }
                    echo ">Брони</a>
                    <form method='GET' action='../admin/index.php' id='roomAdminForm'>
                        <select name='page_admin' id='roomSelect' class='";
                        if(isset($_GET['page_admin']) && ($_GET['page_admin']=='rooms' || $_GET['page_admin']=='catRooms')){
                            echo "activeNavbar'";
                        } else{
                            echo "inactiveNavbar'";
                        }
                        echo ">
                            <option value=''>Управление номерами</option>
                            <option value='rooms'>Номера</option>
                            <option value='catRooms'>Категории номеров</option>
                        </select>
                    </form>
                    <form method='GET' action='../admin/index.php' id='servAdminForm'>
                        <select name='page_admin' id='servSelect' class='";
                        if(isset($_GET['page_admin']) && ($_GET['page_admin']=='services' || $_GET['page_admin']=='catServices')){
                            echo "activeNavbar'";
                        } else{
                            echo "inactiveNavbar'";
                        }
                        echo ">
                            <option value=''>Управление услугами</option>
                            <option value='services'>Услуги</option>
                            <option value='catServices'>Категории услуг</option>
                        </select>
                    </form>
                </div>
                <div id='sign'>";

                    echo "<a href='../exit.php'>Выйти</a><a id='userLogin' href='../account.php?'>".$_SESSION['email']."</a>";
                    
                echo "</div>
            </div>
        </nav>
            ";}
        else{
            echo"
                <nav id='headerNav'>
                <a href='../index.php'><img src='../img/logo.png' alt='logo' id='logoNav'></a>
                <div id='headerNavSpans'>
                    <div id='headerNavigation'>
                        <a href='../'>Главная</a>
                        <a href='../catalog.php'>Каталог</a>
                        <a href='../contacts.php'>Контакты</a>
                        <a href='../services.php'>Услуги</a>";
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                        echo "<a href='../admin/index.php' id='' >Админ панель</a>";
                    }
                    echo "</div>
                    <div id='sign'>";

                        if(isset($_SESSION['id_user'])){
                            echo "<a href='../exit.php'>Выйти</a><a id='userLogin' href='../account.php?'>".$_SESSION['email']."</a>";
                        }
                        else{
                            echo "<span id='signup'>Регистрация</span> <span id='signin'>Авторизация</span>";
                        }

                    echo "</div>
                </div>
            </nav>
                ";
        }
    

    ?>

    <!-- <nav id='headerNav'>
        <img src="../img/logo.png" alt="logo" id='logoNav'>
        <div id="headerNavSpans">
            <div id="headerNavigation">
                <a href="../">Главная</a>
                <a href="../catalog.php">Каталог</a>
                <a href="../contacts.php">Контакты</a>
                <a href="../services.php">Услуги</a>
            </div>
            <div id="sign">
                <?php

                // if(isset($_SESSION['id_user'])){
                //     echo "<a href='../exit.php'>Выйти</a><a id='userLogin' href='../account.php?'>".$_SESSION['email']."</a>";
                // }
                // else{
                //     echo "<span id='signup'>Регистрация</span> <span id='signin'>Авторизация</span>";
                // }

                ?>
            </div>
        </div>
    </nav> -->