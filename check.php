<?php
    
    $a = ctype_space("    ");
    $b = ctype_space("  jnvdvkfnd  ");

    var_dump($a);
    var_dump($b);

?>

&& ctype_space($_POST['pass']) == false  


$_SESSION['message'] = "Заполните все поля!";
    header("Location: ../loginPassChange.php");