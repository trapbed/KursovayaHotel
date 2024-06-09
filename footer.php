<?php
echo "<div class='emtyBetweenContactsFooter'></div>
<hr id='upFooter'>
<div class='emtyUpFooter'></div>

<footer>
    <div id='columnFooter'>
        <img id='logoFoo' src='/img/logoFoo.png' alt='logo footer'>
        <div class='columnFoo'>
            <span>Главная</span>
            <span>Каталог</span>
            <span>Услуги</span>
            <span>Контакты</span>
            <span>Номера</span>
        </div>
        <div class='columnFoo'>
            <a href='recoverAcc.php'>Восстановить аккаунт</a>
            <span>О нас</span>
            <span>Забота о посетителях</span>
            <span>Мы в ВК</span>
            <span>Желаем хорошего дня</span>
        </div>
        <div class='columnFoo'>
            <span>Комфортные номера</span>
            <span>Чистота</span>
            <span>Уют как дома</span>
            <span>Хочется вернуться</span>
        </div>
    </div>
    <span id='coopyright'>(c) 2024 hotel <span>LION</span></span>
</footer>";
// CATALOG
echo "
<script>
    $('#selectCatCatalog').change(function(){
        $('#formCatalog').submit();
    })

    $('#selectNumPersCatalog').change(function(){
        $('#formCatalog').submit();
    })
    $('.fontArial').change(function(){
        $('#formCatalog').submit();
    })
    $('#selectNumRoomsCatalog').change(function(){
        $('#formCatalog').submit();
    })
</script>";
// ADMIN
echo"
<script src='../js/sign.js'></script>
<script>
    $('#roomSelect').change(function () {
        $('#roomAdminForm').submit();
    });
    $('#servSelect').change(function () {
        $('#servAdminForm').submit();
    });
</script>';";
?>