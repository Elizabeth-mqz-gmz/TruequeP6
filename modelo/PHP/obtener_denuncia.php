<?php
  //obtener denuncia
  //Es el bueno x2
  include 'funciones.php';
  $valor = $_POST["tabla"];
  $bd = mysqli_connect('localhost', 'root', '', 'truequep6');
  checar_con($bd);

  if ($valor == "1"){
    $bus = "SELECT id_autor, id_publicacion, publicacion, imagen_publi, razon_denuncia FROM publicacion WHERE denuncia_p = '1'";
  }
  else{
    if ($valor == "2"){
      $bus = "SELECT id_comen, id_usu_comen, comentario FROM comentario WHERE denuncia_c = '1'";
    }
  }

  $resp = mysqli_query($bd, $bus);
  $i=0;
  $respuesta = array();

  while($cosa = mysqli_fetch_assoc($resp)){
    $respuesta[$i]= $cosa;
    $i++;
  }

  echo json_encode($respuesta);

  mysqli_close($bd);
?>
