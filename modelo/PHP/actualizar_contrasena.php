<?php
//actualizar_contrasena.php
  include "funciones.php";
  $bd = conexion();
  checar_con($bd);
  $usuario = dame_cookie();
  $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`~!@$&%^#*()_+\-={}|\[\]\:?,.\/])([A-Za-z\d`~!@$&%^#*()_+\-={}|\[\]\:?,.\/]){8,20}$/";
  $contra = validar($_POST["contrasena"], $regex , $bd);//validar y escapar
  if ($contra != false){
    $contra = sha1("f2wesxdrftgyH3".$contra."B6jxddgvhuijwq");//hacer hash
    $bus = "UPDATE usuario SET contra = '$contra' WHERE id_usuario =  $usuario";
    mysqli_query($bd, $bus);
  }
  else
    echo "Contrasena";
  mysqli_close($bd);
?>
