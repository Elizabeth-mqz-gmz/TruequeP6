<?php
// quitar denuncia
 include "funciones.php";
 $bd = mysqli_connect("localhost", "root", "", "truequep6");
 checar_con($bd);

 $tabla = validar ($_POST["tabla"],"",$bd);
 $publicacion = validar($_POST["publi"], "", $bd);
 $usuario = validar($_POST["usuario"], "", $bd);

 $bus = "UPDATE $tabla SET denuncia_".$tabla[0]." = '0' WHERE id_publicacion = $publicacion"; //quitar denuncia
 mysqli_query($bd, $bus);

 $mensaje = "Fue retirada una denuncia.";//enviar notificación al usuario
 $bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, '$mensaje')";
 mysqli_query($bd, $bus);

 mysqli_close($bd);
?>
