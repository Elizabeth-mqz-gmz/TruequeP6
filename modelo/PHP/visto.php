<?php
    include "funciones.php";
    $usuario = dame_cookie();
    $conex = conexion();
    checar_con($conex);
    $pru = $_POST["notif"];
    $actualNotif = "UPDATE notificacion SET visto='1' WHERE id_not = '$pru'";
    $laNotif = mysqli_query($conex,$actualNotif);
    echo $actualNotif;
    mysqli_close($conex);
?>
