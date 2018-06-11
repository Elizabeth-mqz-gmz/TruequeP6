<?php
//actualizar_imagen.php
  include "funciones.php";
  $bd = conexion();
  checar_con($bd);
  $usuario = dame_cookie();
  $resp = mysqli_query($bd, "SELECT imagen FROM usuario WHERE id_usuario = $usuario");
  $imagen = mysqli_fetch_assoc($resp);
  if ($imagen["imagen"] != "modelo/imagenes_per/default.png"){//Eliminar imagen de perfil
    $imagen["imagen"] = str_replace("modelo", "..", $imagen["imagen"] );//modificar ruta para poder borrar
    unlink($imagen["imagen"]);
  }

  if ($_FILES != null){
    $ruta = "../imagenes_per/";
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    if($tipo == "png"){
      $ruta = $ruta.$_FILES["imagen"]["name"];//para guardar debe ser una ruta
      if(!move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta))
          $ruta = "modelo/imagenes_per/default.png";
      $ruta = "modelo/imagenes_per/".$_FILES["imagen"]["name"];//y debemos cambiarla
    }
    else
      $ruta = "modelo/imagenes_per/default.png";
    }
  else
    $ruta = "modelo/imagenes_per/default.png";

  // echo $ruta."<br />";
  $query = "UPDATE usuario SET imagen = '$ruta' WHERE id_usuario = $usuario";
  mysqli_query($bd, $query);
  mysqli_close($bd);

  header("Location: ../../vista/maquetado/perfil_usuario.php");
?>
