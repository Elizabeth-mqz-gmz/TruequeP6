<?php
//recibe una publicación y un mensaje y los guarda en los comentarios
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
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

    $consul = "INSERT INTO comentario(id_usu_comen,id_publi_comen,comentario) VALUE"."("."'$usuario','$idPub','$comen'".")";
    mysqli_query($db,$consul);
    mysqli_close($db);
 ?>