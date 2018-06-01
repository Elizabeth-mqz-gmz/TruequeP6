<?php
    //abrir base de datos en indexs
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    //$chat = $_POST["chat"];
    $llave = $_POST["llave"];
    $mensajes = "[";
    $busq = $_POST["busq"];
    $resp = mysqli_query($db,$busq);
    while ($row = mysqli_fetch_assoc($resp)) {
        $men = '{"idMen":"'.$row["id_men"].'","mensaje":"'.cifrado($llave,$row["mensaje"],2).'","emisor":"'.$row["emisor"].'"}';
        $mensajes = $mensajes.$men.',';
    }
    if ($mensajes != "["){
      $mensajes = substr($mensajes,0,strlen($mensajes)-1);
      echo $mensajes."]";
    }
    mysqli_close($db);
?>
