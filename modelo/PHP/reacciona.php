<?php
    include "funciones.php";
    $db = conexion();
    checar_con($db);

    $form = [];
    foreach ($_POST as $i => $v) {
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i] = $v;
    }
    $idPub = $form["idPubli"];
    $tipoReac = $form["tipoReac"];
    $usuario = dame_cookie();

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

    //busca al autor de la publicación para enviarle la notificación
    $consul = "SELECT id_autor FROM publicacion WHERE id_publicacion='$idPub'";
    $respu=mysqli_query($db,$consul);
    $row = mysqli_fetch_assoc($respu);
    $autor = $row["id_autor"];

    //el usuario activo es que el aparece en el mensaje de notificación
    $not = "INSERT INTO notificacion(id_usu_not,men_not) VALUE"."("."'$autor','$usuario ha reaccionado $tipoReac a una publicación tuya $idPub'".")";
    echo $not;
    mysqli_query($db,$not);
    mysqli_close($db);
 ?>
