<?php
session_start();
var_dump($_SESSION);
unset($_SESSION['id_user']);
unset($_SESSION['email']);
unset($_SESSION['role']);
unset($_SESSION);
echo "
<script>
alert('Вы вышли из аккаунта!');
location.href = '/';
</script>
";
?>