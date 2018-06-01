<?php
    include "modelo/PHP/funciones.php";
    function getCookie(){ //Regresa el num_cta, si no existe devuelve 0.
        if(isset($_COOKIE)){
            $usu = cifrado("pUeE","usuario",1);
            $cook = $_COOKIE[$usu];
            $cook = cifrado("pUeE",$cook,2);
        }
        else
            $cook = 0;
        return $cook;
    }
    echo getCookie();
?>
