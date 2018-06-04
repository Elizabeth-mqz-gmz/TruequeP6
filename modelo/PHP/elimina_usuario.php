<?php
  //eliminar_usuario.php
  //Diosito ayudame, quiero que esto funcione y se vea bonito
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);
  $usuario = $_POST["usuario"];
  //Elimina parcialmente al usuario :)

  $tablasBD = array(
   "id_usuario" => array ("chat" => "id_rec", "chat" => "id_em,"),
   "id_usuario" => array ("publicacion" => "id_autor", "reaccion" => "id_usu_reac", "notificacion" => "id_usu_not")
  );
  $query = "DELETE FROM reaccion WHERE id_usu_reac = ".$usuario;
  mysqli_query($bd, $query);
  //echo $query;

  $bus = "SELECT id_chat, id_usuario, id_publicacion FROM usuario INNER JOIN chat ON id_rec = id_usuario OR id_em = id_usuario INNER JOIN publicacion ON id_autor = id_usuario WHERE id_usuario = $usuario";
  $resp =  mysqli_query($bd, $bus);
  $n = mysqli_fetch_assoc($resp);
  if ($n == ""){
    $bus = "SELECT id_usuario, id_publicacion FROM usuario  INNER JOIN publicacion ON id_autor = id_usuario WHERE id_usuario = $usuario";
    $resp =  mysqli_query($bd, $bus);
    $n = mysqli_fetch_assoc($resp);
    $tablasBD ["id_publicacion"] = array ("reaccion" => "id_publi_reac", "trueque" => "id_publi_true", "perdida" => "id_publi_per");
    if ($n == ""){
      $bus = "SELECT id_chat, id_usuario FROM usuario INNER JOIN chat ON id_rec = id_usuario OR id_em = id_usuario WHERE id_usuario = $usuario";
      $resp =  mysqli_query($bd, $bus);
      $m = mysqli_fetch_assoc($resp);
      $tablasBD["id_chat"] = array ("mensaje" => "id_chat", "evento" => "id_chat");
    }
  }

  forEach ($tablasBD as $PK => $tablas)
    forEach($tablas as $tabla => $atributo){
      $query = "DELETE FROM $tabla WHERE $atributo = ".$n[$PK];
      //echo $query."<br />";
      mysqli_query($bd, $query);
    }

  while($datos = mysqli_fetch_assoc($resp)){
  forEach ($tablasBD as $PK => $tablas)
    forEach($tablas as $tabla => $atributo){
      $query = "DELETE FROM $tabla WHERE $atributo = ".$datos[$PK];
      echo $query."<br />";
      mysqli_query($bd, $query);
    }
    if(array_key_exists("id_publicacion",$datos)){
      $bus = "DELETE FROM publicacion WHERE id_publicacion = ".$datos["id_publicacion"];
      mysqli_query($bd, $bus);
    }
    if(array_key_exists("id_chat",$datos)){
      $bus = "DELETE FROM chat WHERE id_chat = ".$datos["id_chat"];
      mysqli_query($bd, $bus);
    }
  }

  $query = "DELETE FROM usuario WHERE id_usuario = ".$usuario;
  mysqli_query($bd, $query);

  mysqli_close($bd);
?>
