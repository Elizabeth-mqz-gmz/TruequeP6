<?php
  include "funciones.php";
  $bd = mysqli_connect("localhost","root","","truequep6");
  checar_con($bd);
  if ($_POST["perfilUsu"] != "usuario")
      $id_usuario = $_POST["perfilUsu"];
  else {
      $id_usuario = dame_cookie();
  }
  $resp = mysqli_query($bd, "SELECT id_publicacion FROM publicacion WHERE id_autor = $id_usuario");
  $count = "null";
  $contador = 0; //para saber si es nulo
  $json = ",";
  while($row=mysqli_fetch_assoc($resp)){
      if($contador==0)
          $count = $row["id_publicacion"];
      $json.= $row["id_publicacion"].",";
  }
  // echo $id_usuario;
  if($count!="null")
      echo $json;
  else
      echo "null";

  mysqli_close($bd);
?>
