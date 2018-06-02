<?php
//manda todas los id publicaciones en un json
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i => $v){
        validar($i,"",$db);
        validar($v,"",$db);
        $form[$i] = $v;
    }
    $tipo = $form["tipoPubli"];
    if($tipo=="trueque")
        $col = "id_publi_true";
    else if($tipo=="perdida")
        $col = "id_publi_per";

    $busq = "SELECT $col FROM $tipo";
    $resp = mysqli_query($db,$busq);
    $fila = mysqli_fetch_assoc($resp);
    $count = $fila[$col];
    $json = "[";
    while($row=mysqli_fetch_assoc($resp))
        $json.= $row[$col].",";
    $json[strlen($json)-1]="]";
    if($count!=null)
        echo $json;
    else
        echo "null";
?>
