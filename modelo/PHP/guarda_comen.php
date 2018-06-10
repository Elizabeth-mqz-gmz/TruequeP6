<?php
//recibe una publicación y un mensaje y los guarda en los comentarios
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
    $comen = $form["comen"];
    $usuario = dame_cookie();

    $consul = "INSERT INTO comentario(id_usu_comen,id_publi_comen,comentario) VALUES"."("."'$usuario','$idPub','$comen'".")";
    mysqli_query($db,$consul);
    mysqli_close($db);
 ?>
