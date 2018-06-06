<?php
  include "funciones.php";

  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $id_chat = validar($_POST["chat"], "", $bd);
  $fecha = validar($_POST["fecha"], "", $bd);
  $evento = validar($_POST["evento"], "", $bd);
  $lugar = validar($_POST["lugar"], "", $bd);

  $bus = "INSERT INTO evento (id_chat, fecha, tipo_even, lugar) VALUES ($id_chat, '$fecha', '$evento', '$lugar')";
  mysqli_query($bd, $bus);
  echo $bus;

  mysqli_close($bd);

?>
