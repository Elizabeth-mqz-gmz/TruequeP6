<?php
    include "funciones.php";
    $usuario = dame_cookie();
    $conex = conexion();
    checar_con($conex);
    //Busca NOTIFICACIONES
    $busNotif = "SELECT id_not, men_not, visto FROM notificacion WHERE id_usu_not = $usuario";
    $allNotif = mysqli_query($conex,$busNotif);
    $jsonNotif = array();
    $i = 0;
    while($tomaNotif = mysqli_fetch_assoc($allNotif)){
        $jsonNotif[$i] = $tomaNotif;
        $i++;
    }
    $json = [];
    $json = json_encode($jsonNotif);
    print_r($json);
    mysqli_close($conex);
?>
