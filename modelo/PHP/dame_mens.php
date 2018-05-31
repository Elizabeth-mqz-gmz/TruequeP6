<?php
    //abrir base de datos en indexs
    include "../../controlador/php/funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $chat = $_POST["chat"];
    $mensajes = "1er_men";
    $busq = "SELECT mensaje,emisor FROM mensaje  where id_chat = $chat;";
    $resp = mysqli_query($db,$busq);
    while ($row = mysqli_fetch_assoc($resp)) {
      if ($mensajes == "1er_men" )
        $mensajes = '[{"mensaje":"'.$row["mensaje"].'","emisor":"'.$row["emisor"].'"}';
      else{
        $men = '{"mensaje":"'.$row["mensaje"].'","emisor":"'.$row["emisor"].'"}';
        $mensajes = $mensajes.','.$men;
      }
    }
    echo $mensajes.']';
    mysqli_close($db);
?>
