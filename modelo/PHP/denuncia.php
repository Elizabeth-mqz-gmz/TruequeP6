<?php
//abre base de datos, recibe de un ajax un número id_publicacion
//cambia al atributo denuncia_p a 1
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    $form = [];
    foreach($_POST as $i => $v){
        validar($i,"",$db);
        validar($v,"",$db);
        $form[$i] = $v;
    }
    $idPub = $form["idPubli"];
    $denuncia = $form["motivo"];
    validar($denuncia,"/[A-Za-z\d]{20,200}$/",$db);
    //actualiza el estado de una publicación, y cambia a 1 el atributo denuncia
    $upd = "UPDATE publicacion SET denuncia_p='1',razon_denuncia='$denuncia' WHERE id_publicacion='$idPub'";
    mysqli_query($db,$upd);
    echo $upd;
    mysqli_close($db);

?>
