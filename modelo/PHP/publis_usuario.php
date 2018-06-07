<?php
  include "funciones.php";
  $bd = mysqli_connect("localhost","root","","truequep6");
  checar_con($bd);
  if ($_POST["perfilUsu"] != "usuario") //Eso se manda en el ajax cuando el usuario que busca es él mismo
      $id_usuario = $_POST["perfilUsu"];
  else //Como se busca a él mismo, se saca el número de cuenta de la cookie que hicimos en login
      $id_usuario = dame_cookie();

  $resp = mysqli_query($bd, "SELECT id_publicacion FROM publicacion WHERE id_autor = $id_usuario");
  $count = "null";
  $contador = 0; //para saber si es nulo
  $json = ",";
  while($row=mysqli_fetch_assoc($resp)){
      if($contador==0)
          $count = $row["id_publicacion"];
      $json.= $row["id_publicacion"].","; //Juntar los id's de las publicaciones en las que el usario es el autor
  }
  // echo $id_usuario;
  if($count!="null") // Hay publicaciones, manda el json de éstas
      echo $json;
  else
      echo "null"; //Envía null para validar en js que el usuario no ha publicado nada 

  mysqli_close($bd);
?>
