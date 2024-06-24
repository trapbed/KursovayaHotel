<?php
session_start();
session_unset();
echo "
<script>
alert('Вы вышли из аккаунта!');
location.href = '/';
</script>
";
?>