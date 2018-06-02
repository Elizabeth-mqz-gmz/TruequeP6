<?php
//envía una notificación cuando un usuario da me interesa la publicación
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    $usuario= dame_cookie();
    $not = "INSERT INTO notificacion(id_usu_not,men_not) VALUE"."("."'$usuario','Al usuario $usuario le interesa una publicación tuya'".")";
    mysqli_query($db,$not);
    mysqli_close($db);
?>
