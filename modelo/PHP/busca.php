<?php
  //buscar.php
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);
  $num_cta = validar($_POST["usuario"],"/^(31)[6789][0-9]{6}/",$bd);

  if($num_cta != false){//verifica que compla con la regex
    $bus = "SELECT nomus FROM usuario WHERE id_usuario = $num_cta";//revisa si existe coincidencia
    $resp = mysqli_query($bd, $bus);
    $exist = mysqli_num_rows($resp);
    if ($exist > 0){
        echo "existe";
    }
  }
  else
    echo "false";
  mysqli_close($bd);
?>
