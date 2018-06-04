<?php
  // cookie.php
  include "funciones.php";
  // :)
  $usu = dame_cookie();
  if($_POST["val"] == "0"){
    if ($usu == "979847874"){//revisar que efectivamente sea el admi
      if($_COOKIE["#Q"]!= null){
        $datos = array();
        $datos["ruta"] = "Admi.php";
        $datos["script"] = "..\\..\\controlador\\JS\\administrador.js";
        $json = json_encode($datos);
        echo $json; //añadir esto para poder hacer cosas de admi
      }
      else {
        echo "false";
      }
    }
  }
  else {
    if ($_POST["val"] == "1" )
      if($usu != 0)
        echo "cookie";
  }

?>
