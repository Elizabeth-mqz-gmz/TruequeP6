<?php
    //abrir base de datos en indexs
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    //$chat = $_POST["chat"];
    $llave = $_POST["llave"]; //Para descifrar
    $mensajes = "[";
    $busq = $_POST["busq"];
    $resp = mysqli_query($db,$busq);
    while ($row = mysqli_fetch_assoc($resp)) { //Sacar los mensajes y hacerlos un json
        $men = '{"idMen":"'.$row["id_men"].'","mensaje":"'.cifrado($llave,$row["mensaje"],2).'","emisor":"'.$row["emisor"].'","hora":"'.$row["hora_men"].'"},';
        $mensajes .= $men;
    }
    if ($mensajes != "["){ //Sólo manda respuesta cuando sí encontró nuevos mensajes, sino, retorna ""
      $mensajes[strlen($mensajes)-1]="]";
      echo $mensajes;
    }
    mysqli_close($db);
?>
