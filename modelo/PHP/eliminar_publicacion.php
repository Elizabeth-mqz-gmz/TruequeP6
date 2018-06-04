<?php
  //eliminar publicación;
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $tabla = $_POST["tabla"];
  $publicacion = validar($_POST["publicacion"], "", $bd);
  $usuario = validar ($_POST["usuario"], "", $bd);

   if($tabla == "1"){
     $resp = mysqli_query($bd, "SELECT imagen_publi FROM publicacion WHERE id_publicacion = $publicacion");
     $bus = mysqli_fetch_assoc($resp);
     if ($bus["imagen_publi"] != null)
       unlink($bus["imagen_publi"]); //eliminar imagen del subdirectorio imagenes_pub
  //eliminar imagen publicacion
  }
  if ($tabla == "1"){
    $tabla = array("perdida" => "id_publi_per", "trueque" => "id_publi_true", "reaccion" => "id_publi_reac",
    "comentario" => "id_publi_comen","publicacion" => "id_publicacion");

    forEach($tabla as $i => $ele){//ahora está más lindo :)
      $bus = "DELETE FROM $i WHERE $ele = $publicacion";
      mysqli_query($bd,$bus);
    }
  }
  else if($tabla == "2"){
    echo "2";
    $bus = "DELETE FROM comentario WHERE id_comen = $publicacion";
    $busca =   mysqli_query($bd, $bus);
    echo $bus;
  }

  //mysqli_query($bd, $bus)
  echo $busca;
  $mensaje = "Quitamos tu publicación."; //notificación
  //$bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, $mensaje)";
  //mysqli_query($bd, $bus);

  echo "Se ha eliminado la publicación";


  mysqli_close($bd);

?>
