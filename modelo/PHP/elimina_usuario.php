<?php
  //eliminar_usuario.php
  //Diosito ayudame, quiero que esto funcione y se vea bonito
  include "funciones.php";
  $bd = conexion();
  checar_con($bd);
  $usuario = validar($_POST["usuario"],"", $bd);
  if ($usuario != "979847874"){//verificar que no autoelimines XD
  //Elimina parcialmente al usuario :)
    //obtener datos para eliminar todo lo relacionado con él ;)
    $publicaciones = "SELECT id_publicacion FROM publicacion WHERE id_autor = $usuario";
    $chats = "SELECT id_chat FROM chat WHERE $usuario = id_em OR $usuario = id_rec";
    $usuariobd = "SELECT id_usuario FROM usuario WHERE id_usuario = $usuario";
    $query = array("id_publicacion" => $publicaciones,"id_chat"=> $chats, "id_usuario" => $usuariobd);
    //arreglos para meterlos dentro de un forEach;

    $resp = mysqli_query($bd, "SELECT imagen_publi FROM publicacion WHERE id_autor = $usuario");
    while($imagen = mysqli_fetch_assoc($resp)){//eliminar todas las imagenes relacionadas con las publicaciones del usuario
    if ($imagen["imagen_publi"] != null)
      unlink($imagen["imagen_publi"]);
    }
    $eliminar = array(//matriz genial :)
    "id_publicacion" => array (
      "perdida" => "id_publi_per",
      "trueque" => "id_publi_true",
      "reaccion" => "id_publi_reac",
    ),
    "id_chat" => array ("mensaje" => "id_chat", "evento" => "id_chat" ),
    "id_usuario" => array(
      "reaccion" => "id_usu_reac",
      "comentario" => "id_usu_comen",
      "publicacion" => "id_autor",
      "notificacion" => "id_usu_not",
      "chat" => "id_rec",
      "chat" => "id_em",
      "usuario" => "id_usuario")
    );

    forEach($query as $indice => $elemento){//Cosa Hermosa Que Elimina Todo <3
      $resp = mysqli_query($bd, $elemento); //eliminar todo lo relacionado con las publicaciones
      while ($resultado = mysqli_fetch_assoc($resp)){
        forEach($eliminar[$indice] as $id => $ele){
          $bus = "DELETE FROM $id WHERE $ele =".$resultado[$indice];
          mysqli_query($bd, $bus);
        }
      }
    }

  }
  else
    echo "No";
  mysqli_close($bd);
?>
