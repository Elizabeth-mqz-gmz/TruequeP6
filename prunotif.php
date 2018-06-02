<!-- funcion que lee la cookie y entonces busca en la base de datos -->
    <?php
        include "modelo/PHP/funciones.php";
        $usuario = dame_cookie();
        // echo $usuario;
        $conex = mysqli_connect('localhost','root','','truequep6');
        checar_con($conex);
        //NOTIFICACIÓN DE BIENVENIDA
        $busBien = "SELECT id_not FROM notificacion WHERE id_usuario = ".$usuario."";
        $unico = mysqli_query($conex,$busBien);
        $exist = mysqli_num_rows($unico);
        if($exist == 0){ //REVISA SI EL REGISTRO EXISTE
            $inserta = "INSERT INTO notificacion (id_usuario, men_not, tipo_not) VALUES "."($usuario,'¡Felicidades, de has registrado en Trueque-P6','evento')";
            echo $inserta;
            $resp=mysqli_query($conex,$inserta);
        }
        //MUESTRA NUMERO DE NOTIFICACIONES EN NAAVBBAAAR
        $num = num_notif($usuario, $conex);
        
    ?>
