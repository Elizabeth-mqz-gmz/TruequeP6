<?php
    include 'funciones.php';
    $usuario = dame_cookie();
    $conex = mysqli_connect('localhost','root','','truequep6');
    checar_con($conex);

    $busBien = "SELECT id_not FROM notificacion WHERE id_usu_not = ".$usuario."";
    $unico = mysqli_query($conex,$busBien);
    $exist = mysqli_num_rows($unico);
    if($exist == 0){ //REVISA SI EL REGISTRO EXISTE
        $inserta = "INSERT INTO notificacion (id_usu_not, men_not) VALUES "."($usuario,'¡Felicidades, te has registrado en Trueque-P6 :)')";
        $resp=mysqli_query($conex,$inserta);
    }
    mysqli_close($conex);
?>
