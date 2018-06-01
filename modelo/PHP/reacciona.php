<?php
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);

    $form = [];
    foreach ($_POST as $i => $v) {
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i] = $v;
    }
    $idPub = $form["idPubli"];
    $tipoReac = $form["tipoReac"];
    $usuario = 31700001; //FALTA sacar de cookie

    //si la reacción ya existe, la devuelve
    $busq = "SELECT id_reaccion FROM reaccion WHERE id_publi_reac='$idPub' AND id_usu_reac='$usuario'";
    $resp = mysqli_query($db,$busq);
    $row = mysqli_fetch_array($resp);

    //si no existe, la crea, si no existe, la actualiza
    if($row[0]==null)
        $busq = "INSERT INTO reaccion(id_publi_reac,id_usu_reac,tipo_reac) VALUES "."("."'$idPub','$usuario','$tipoReac'".")";
    else
        $busq = "UPDATE reaccion SET tipo_reac='$tipoReac' WHERE id_publi_reac='$idPub' AND id_usu_reac='$usuario'";
    echo $busq;
    mysqli_query($db,$busq);
    mysqli_close($db);
 ?>
