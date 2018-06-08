<?php
//envía una notificación cuando un usuario da me interesa la publicación
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    $idPub = $form["idPubli"];
    //busca al autor de la publicación para enviarle la notificación
    $consul = "SELECT id_autor FROM publicacion WHERE id_publicacion='$idPub'";
    $resp=mysqli_query($db,$consul);
    $row = mysqli_fetch_assoc($resp);
    $autor = $row["id_autor"];

    //el usuario activo es que el aparece en el mensaje de notificación
    $usuario= dame_cookie();
    $not = "INSERT INTO notificacion(id_usu_not,men_not) VALUE"."("."'$autor','Al usuario $usuario le interesa una publicación tuya'".")";
    mysqli_query($db,$not);
    mysqli_close($db);
?>
