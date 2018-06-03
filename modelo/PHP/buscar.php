<?php
  //buscar.php
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $num_cta = validar($_POST["id_usu"],"/^(31)[6789][0-9]{6}/",$bd);
  //$num_cta = 317141712;

  if($num_cta != false){//verifica que compla con la regex
    $bus = "SELECT id_usuario FROM usuario WHERE id_usuario = $num_cta";//revisa si existe coincidencia
    $resp = mysqli_query($bd, $bus);
    if ($resp != null){
        //lo que deba hacer
        echo "Funciona!!";
    }
    else{
      echo "F"; //mandar este mensaje a pantalla
    }
  }
  else {
    echo "F";
  }

  mysqli_close($bd);

?>
