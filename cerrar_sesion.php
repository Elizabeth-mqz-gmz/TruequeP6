<?php
    include "modelo/PHP/funciones.php";
    $usu = cifrado("pUeE","usuario",1);
    $admin = cifrado("pUeE","ok",1);
    if(isset($_COOKIE[$usu]))
        setcookie($usu,'',time()-3600,'/');
    if(isset($_COOKIE[$admin]))
        setcookie($admin,'',time()-3600,'/');
    header("Location: index.php");
?>
