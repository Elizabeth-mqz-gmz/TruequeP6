    <?php
        include "funciones.php";
        $usuario = dame_cookie();
        $conex = conexion();
        checar_con($conex);
        //MUESTRA NUMERO DE NOTIFICACIONES EN NAAVBBAAAR
        $busNum = "SELECT id_not FROM notificacion WHERE id_usu_not = ".$usuario." AND visto = '0'";
        $encuentra = mysqli_query($conex,$busNum);
        $num = mysqli_num_rows($encuentra);
        echo $num;
        mysqli_close($conex);
    ?>
