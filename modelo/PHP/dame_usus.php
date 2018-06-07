<?php
  include "funciones.php";
  $bd = mysqli_connect("localhost","root","","truequep6");
  checar_con($bd);
  $otro = $_POST["otro"]; //Tomar el nnum de cuenta de la persona con la que quiere chatear

  $resp = mysqli_query($bd, "SELECT nomus FROM usuario WHERE id_usuario =".dame_cookie().";");
  $usuNomus = mysqli_fetch_array($resp)[0]; //Tomar un nombre de usuario
  $resp = mysqli_query($bd, "SELECT nomus FROM usuario WHERE id_usuario = $otro ;");
  $recNomus = mysqli_fetch_array($resp)[0]; //Tomar el 2do nombre de usuario
  echo "{\"usuario\":\"".dame_cookie()."\",\"usuNomus\":\"$usuNomus\",\"usuRec\":\"$recNomus\"}";

  mysqli_close($bd);
?>
