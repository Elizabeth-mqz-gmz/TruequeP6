<?php
// quitar denuncia
 include "funciones.php";
 $bd = mysqli_connect("localhost", "root", "", "truequep6");
 checar_con($bd);

 $publicacion = validar($_POST["publi"], "", $bd);
 $usuario = validar($_POST["usuario"], "", $bd);

 $bus = "UPDATE publicacion SET denuncia_p = '0' WHERE id_publicacion = $publicacion"; //quitar denuncia
 mysqli_query($bd, $bus);

 $mensaje = "Fue retirada una denuncia.";
 $bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, '$mensaje')";
 mysqli_query($bd, $bus);

 echo "Cambio realizado con exito";

 mysqli_close($bd);
?>
