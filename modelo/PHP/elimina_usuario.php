<?php
  //eliminar_usuario.php
  //Diosito ayudame, quiero que esto funcione y se vea bonito
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);
  $usuario = $_POST["usuario"];

  $bus = "SELECT id_chat, id_usuario, id_publicacion FROM usuario INNER JOIN chat ON id_rec = id_usuario OR id_em = id_usuario INNER JOIN publicacion ON id_autor = id_usuario WHERE id_usuario = $usuario";
  $resp =  mysqli_query($bd, $bus);
  $datos = mysqli_fetch_assoc($resp);//obtener las llaves primarias :)

  $id_usu = $_POST["usuario"];
  $tablasBD = array(
   "id_publicacion" => array ("reaccion" => "id_publi_reac", "trueque" => "id_publi_true", "perdida" => "id_publi_per"),
   "id_chat" => array ("mensaje" => "id_chat", "evento" => "id_chat"),
   "id_usuario" => array ("chat" => "id_rec", "chat" => "id_em,"),
   "id_usuario" => array ("publicacion" => "id_autor", "reaccion" => "id_usu_reac", "notificacion" => "id_usu_not", "usuario" => "id_usuario")
  );

  forEach ($tablasBD as $PK => $tablas)
    forEach($tablas as $tabla => $atributo){
      $query = "DELETE FROM $tabla WHERE $atributo = ".$datos[$PK];
      mysqli_query($bd, $query);
    }

  mysqli_close($bd);
?>
