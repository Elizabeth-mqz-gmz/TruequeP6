<?php
    //abrir base de datos en indexs
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $men = validar($_POST["men"],"",$db); //Recibir la información
    $chat = validar($_POST["chat"],"",$db);
    $emisor = validar($_POST["envia"],"",$db);
    $llave = $_POST["llave"];
    $busq = "INSERT INTO mensaje VALUES "."("."'','".validar(cifrado($llave,$men,1),"",$db)."','$chat','$emisor'".");";
    mysqli_query($db,$busq); //meter el mensaje en la bd cifrado 
    // echo $busq;
    // echo "Enviado!";
    mysqli_close($db);
?>
