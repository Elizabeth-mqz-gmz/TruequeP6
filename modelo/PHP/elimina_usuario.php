<?php
  //eliminar_usuario.php
  //Diosito ayudame, quiero que esto funcione y se vea bonito
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $bus = ""; //query hermosa para eliminar todo lo relacionado con el usuario; 

  mysqli_close($bd);
?>
