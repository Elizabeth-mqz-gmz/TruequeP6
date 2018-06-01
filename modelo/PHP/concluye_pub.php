<?php
//abre base de datos, recibe de un ajax un número id_publicacion
//y estado: terminado o inconcluso, lo intercambia
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
    $estado= $form["estado"];
    //actualiza el estado de una publicación, si es inconcluso lo vuelve terminado y viceversa
    $upd = "UPDATE publicacion SET estado='$estado' WHERE id_publicacion='$idPub'";
    mysqli_query($db,$upd);
    mysqli_close($db);
?>
