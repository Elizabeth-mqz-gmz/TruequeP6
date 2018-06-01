<?php
//inicio_esion.php
  extract($_POST);

  include "funciones.php";
  $datosUsu = array ("id_usuario" => $_POST["id_usuario"] , "contra" => $_POST["contra"]);
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  forEach($datosUsu as $ind => $ele)
    $datosUsu[$ind]= validar($ele,"", $bd);//escapar datos ingresados por el usuario

  $bus = "SELECT id_usuario, contra FROM usuario WHERE id_usuario = ".$datosUsu["id_usuario"];
  $resp = mysqli_query($bd, $bus);
  $bus = mysqli_fetch_assoc($resp);

  if($bus != null){//solo si existe coincidencia verifica que la contraseña sea la correcta
    $datosUsu["contra"] = sha1("f2wesxdrftgyH3".$datosUsu["contra"]."B6jxddgvhuijwq");//hace el hash
    if($bus["contra"]== $datosUsu["contra"]){
      echo "T";
      if ($datosUsu["id_usuario"] == 979847874) //revisa si coincide con el id de administrador
        echo "T";
      }
    else
      echo "F";
    }
  else
    echo "F";

  mysqli_close($bd);

?>
