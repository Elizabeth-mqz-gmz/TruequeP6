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
    //arreglos para meterlos dentro de un forEach;
    $publicacion = array (
      "perdida" => "id_publi_per",
      "trueque" => "id_publi_true",
      "reaccion" => "id_publi_reac",
    );
    $resp = mysqli_query($bd, $publicaciones); //eliminar todo lo relacionado con las publicaciones
    while ($id_publicacion = mysqli_fetch_assoc($resp)){
      forEach($publicacion as $id => $ele){
        $query = "DELETE FROM $id WHERE $ele =".$id_publicacion["id_publicacion"];
        mysqli_query($bd, $query);
      }
    }
    $chat = array ("mensaje", "evento" );
    $resp = mysqli_query($bd, $chats); //eliminar todo lo relacionado con las publicaciones
    while ($id_chat = mysqli_fetch_assoc($resp)){
      forEach($chat as $id => $ele){
        $query = "DELETE FROM $ele WHERE id_chat = ".$id_chat["id_chat"];//
        mysqli_query($bd, $query);
      }
    }
    $usuarioBD = array(
      "reaccion" => "id_usu_reac",
      "comentario" => "id_usu_comen",
      "publicacion" => "id_autor",
      "notificacion" => "id_usu_not",
      "chat" => "id_rec",
      "chat" => "id_em",
      "usuario" => "id_usuario"
    );
    forEach($usuarioBD as $id => $ele){
      $query = "DELETE FROM $id WHERE $ele = $usuario";//error
      mysqli_query($bd, $query);
      }
  }
  else
    echo "No";
  mysqli_close($bd);
?>
