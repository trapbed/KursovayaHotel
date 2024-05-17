<?php
session_start();
var_dump($_SESSION);
unset($_SESSION['id_user']);
unset($_SESSION['email']);
echo "
<script>
alert('Вы вышли из аккаунта!');
location.href = '/';
</script>
";
?>