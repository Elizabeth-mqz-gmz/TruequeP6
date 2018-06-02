<?php
// quitar denuncia
 include "funciones.php";
 $bd = mysqli_connect("localhost", "root", "", "truequep6");
 checar_con($bd);

 $tabla = $_POST["tabla"];
 $publicacion = validar($_POST["publicacion"], "", $bd);
 $usuario = validar($_POST["usuario"], "", $bd);

 if($tabla == "1")
  $bus = "UPDATE publicacion SET denuncia_p = '0' WHERE id_publicacion = $publicacion"; //quitar denuncia
 else {
    if($tabla =="2")
      $bus = "UPDATE comentario SET denuncia_p = '0' WHERE id_comen = $publicacion";
}

 $mensaje = "Fue retirada una denuncia.";//enviar notificación al usuario
 $bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, '$mensaje')";
 mysqli_query($bd, $bus);

 mysqli_close($bd);
?>
