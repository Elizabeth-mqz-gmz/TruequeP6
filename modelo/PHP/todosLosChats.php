<?php
include "funciones.php";
$db = conexion();
checar_con($db);
//Datos que se definen para la búsqueda
$usuario = dame_cookie(); //USUARIO QUE ESTÁ ABIERTO EN LA PÁGINA
$pers = "[";
$busq = "SELECT * FROM chat WHERE id_em='$usuario' OR id_rec='$usuario';"; //Tomar todos los chats en dónde aparezca el usuario
$resp = mysqli_query($db,$busq);
while($row = mysqli_fetch_assoc($resp)){ //Ir seleccionando el nombre de usuario de las personas con las que ha chateado
  if($row["id_em"] == $usuario) //Checar su la otra persona es emisor o receptor
      $busq2 = "SELECT nomus,id_usuario FROM usuario WHERE id_usuario =".$row["id_rec"]; //Por eso se intercambia acá
  else
      $busq2 = "SELECT nomus,id_usuario FROM usuario WHERE id_usuario =".$row["id_em"]; //y acá
  $resp2= mysqli_query($db,$busq2); //se hace la búsqueda
  $aux = mysqli_fetch_array($resp2);
  $pers = $pers.'{"usuario":"'.$aux["id_usuario"].'","nomus":"'.$aux["nomus"].'"},'; // //Concatenar el json
}
$pers[strlen($pers)-1]="]";
echo $pers;
?>
