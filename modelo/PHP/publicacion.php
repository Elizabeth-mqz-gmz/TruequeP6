<?php
//abre base de datos, recibe de un ajax un número id_publicacion
//devuelve un echo, el json o null
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    $form = [];
    foreach($_POST as $i => $v){
        validar($i,"",$db);
        validar($v,"",$db);
        $form[$i] = $v;
    }
    echo dame_publicacion($form["idPubli"],$db);
    mysqli_close($db);
?>
