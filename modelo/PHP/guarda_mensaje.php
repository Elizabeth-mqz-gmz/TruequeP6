<?php
    //abrir base de datos en indexs
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    $men = validar($_POST["men"],"",$db); //Recibir la información
    $chat = validar($_POST["chat"],"",$db);
    $emisor = validar($_POST["envia"],"",$db);
    $hora = validar($_POST["horaMen"],"",$db);
    $llave = $_POST["llave"];
    $busq = "INSERT INTO mensaje VALUES "."("."'','".validar(cifrado($llave,$men,1),"",$db)."','$chat','$emisor','$hora:00'".");";
    mysqli_query($db,$busq); //meter el mensaje en la bd cifrado
    echo $busq;
    // echo "Enviado!";
    mysqli_close($db);
?>
