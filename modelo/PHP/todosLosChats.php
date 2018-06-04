<?php
include "funciones.php";
$db = mysqli_connect("localhost","root","","truequep6");
checar_con($db);
//Datos que se definen para la búsqueda
$usuario = dame_cookie(); //USUARIO QUE ESTÁ ABIERTO EN LA PÁGINA
$pers = "[";
$busq = "SELECT * FROM chat WHERE id_em='$usuario' OR id_rec='$usuario';"; //VER SI YA EXISTE EL CHAT CON EL USUARIO COMO EMISOR (emisor = persona que envió el 1er mns)
$resp = mysqli_query($db,$busq);
while($row = mysqli_fetch_assoc($resp)){
  if($row["id_em"] == $usuario)
      $busq2 = "SELECT nomus,id_usuario FROM usuario WHERE id_usuario =".$row["id_rec"];
  else
      $busq2 = "SELECT nomus,id_usuario FROM usuario WHERE id_usuario =".$row["id_em"];
  $resp2= mysqli_query($db,$busq2);
  $aux = mysqli_fetch_array($resp2);
  $pers = $pers.'{"usuario":"'.$aux["id_usuario"].'","nomus":"'.$aux["nomus"].'"},';
}
$pers[strlen($pers)-1]="]";
echo $pers;
?>
