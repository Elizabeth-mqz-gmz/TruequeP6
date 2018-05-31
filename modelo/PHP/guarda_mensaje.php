<?php
    //abrir base de datos en indexs
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $men = validar($_POST["men"],"",$db);
    $chat = validar($_POST["chat"],"",$db);
    $emisor = validar($_POST["envia"],"",$db);
    $busq = "INSERT INTO mensaje VALUES "."("."'','$men','$chat','$emisor'".");";
    mysqli_query($db,$busq);
    echo "Enviado!";
    mysqli_close($db);
?>
