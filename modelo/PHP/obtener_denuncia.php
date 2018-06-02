<?php
  //obtener denuncia
  include 'funciones.php';
  $val = $_POST ["denuncia"];//obtener si serán denuncias o comentarios
  $bd = mysqli_connect('localhost', 'root', '', 'truequep6');
  checar_con($bd);
  //obtiene todas las publicaciones que presentan alguna denuncia
  if ($val = "1")
    $resp = mysqli_query($bd, "SELECT id_autor, id_publicacion FROM publicacion WHERE denuncia_p = '1'");
//  else
//    $resp = mysqli_query($bd, "SELECT id_usu_comen, id_publi_comen FROM comentario WHERE denuncia_c = '1'");
  $i=0;
  $denuncia = array();
  while($den = mysqli_fetch_assoc($resp)){
    $denuncia[$i]=$den;
    $i++;
  }
  $denuncia = json_encode($denuncia);
  print_r($denuncia);
  mysqli_close($bd);
?>
