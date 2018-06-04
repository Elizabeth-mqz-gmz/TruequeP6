<?php
//inicio_sesion.php
  include "funciones.php";

  $datosUsu = array ("id_usuario" => $_POST["id_usuario"] , "contra" => $_POST["contra"]);

  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);
  forEach($datosUsu as $ind => $ele)
    $datosUsu[$ind]= validar($ele,"", $bd);//escapar datos ingresados por el usuario

  $bus = "SELECT id_usuario, contra FROM usuario WHERE id_usuario = ".$datosUsu["id_usuario"];
  $resp = mysqli_query($bd, $bus);
  $bus = mysqli_fetch_assoc($resp);
  //$datosUsu["id_usuario"] = (int)$datosUsu["id_usuario"];

  if($bus != null){//solo si existe coincidencia verifica que la contraseña sea la correcta

    $datosUsu["contra"] = sha1("f2wesxdrftgyH3".$datosUsu["contra"]."B6jxddgvhuijwq");//hace el hash
    if($bus["contra"]== $datosUsu["contra"]){

      echo "T";
      $usu = cifrado("pUeE","usuario",1);
      $numeroCuenta = cifrado("pUeE", $datosUsu["id_usuario"], 1);
      setcookie($usu,$numeroCuenta,time()+3600*24*30,"/");//crear cookie
      if ($datosUsu["id_usuario"] == "979847874"){ //revisa si coincide con el id de administrador

        //echo $datosUsu["id_usuario"];
        echo "T";
        $usu = cifrado("pUeE","ok",1);//crear cookie para ver si eres admi
        //echo $usu;
        setcookie($usu,$numeroCuenta,time()+3600*24*30,"/");
        }
    }
    else{
      echo "F";
    }
  }
  else
    echo "F";

  mysqli_close($bd);
?>
