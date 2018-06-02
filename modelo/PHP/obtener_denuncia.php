<?php
  //obtener denuncia
  include 'funciones.php';
  $valor = $_POST["tabla"];
  $bd = mysqli_connect('localhost', 'root', '', 'truequep6');
  checar_con($bd);
  //obtiene todas las publicaciones que presentan alguna denuncia
  if($valor == "1"){
    $resp = mysqli_query($bd, "SELECT id_autor, id_publicacion FROM publicacion WHERE denuncia_p = '1'");
    $usu = "id_autor";
    $id = "id_publicacion";
    }
  else {
    if($valor == "2"){
      $resp = mysqli_query($bd, "SELECT id_usu_comen, id_comen FROM comentario WHERE denuncia_p = '1'");
      $usu = "id_usu_comen";
      $id = "id_comen";
    }
  }
  $i=0;
  $denuncia = array();
  while($den = mysqli_fetch_assoc($resp)){
    $denuncia[$i]["id_autor"]=$den[$usu];
    $denuncia[$i]["id_publicacion"]=$den[$id];
    $i++;
  }
  $denuncia = json_encode($denuncia);
  print_r($denuncia);
  mysqli_close($bd);
?>
