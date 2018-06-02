<?php
  //obtener denuncia
  include 'funciones.php';
  $bd = mysqli_connect('localhost', 'root', '', 'truequep6');
  checar_con($bd);
  //obtiene todas las publicaciones que presentan alguna denuncia
  $resp = mysqli_query($bd, "SELECT id_autor, id_publicacion FROM publicacion WHERE denuncia_p = '1'");
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
