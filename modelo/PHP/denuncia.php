<?php
//abre base de datos, recibe de un ajax un número id_publicacion
//cambia al atributo denuncia_p a 1
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i => $v){
        validar($i,"",$db);
        validar($v,"",$db);
        $form[$i] = $v;
    }
    $idPub = $form["idPubli"];

    //actualiza el estado de una publicación, y cambia a 1 el atributo denuncia
    $upd = "UPDATE publicacion SET denuncia_p='1' WHERE id_publicacion='$idPub'";
    mysqli_query($db,$upd);
    mysqli_close($db);
?>