<?php
//inicio_sesion.php
  include "funciones.php";
  $datosUsu = array ("id_usuario" => $_POST["id_usuario"] , "contra" => $_POST["contra"]);
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);
  forEach($datosUsu as $ind => $ele)
    $datosUsu[$ind]= validar($ele,"", $bd);//escapar datos ingresados por el usuario
  $bus = "SELECT id_usuario, contra FROM usuario WHERE id_usuario = ".$datosUsu["id_usuario"]; //query bonita, pero no tanto como la de calnedario XD
  $resp = mysqli_query($bd, $bus);
  $bus = mysqli_fetch_assoc($resp);
  //print_r($bus);
  if($bus != null){
    if($bus["contra"]== $datosUsu["contra"]){//falta hacer hash
      echo "T";
      if ($datosUsu["id_usuario"] == 979847874) //revisa si coincide con el id de administrador
        echo ",Admi";
      }
    else
      echo "F";
    }
  else
    echo "F";

  mysqli_close($bd);

?>
