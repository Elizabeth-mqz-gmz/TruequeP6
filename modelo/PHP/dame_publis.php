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
    //depende si es trueque o perdida son las que manda
    $tipo = $form["tipoPubli"];
    if($tipo=="trueque")
        $col = "id_publi_true";
    else if($tipo=="perdida")
        $col = "id_publi_per";

    $busq = "SELECT $col FROM $tipo";
    $resp = mysqli_query($db,$busq);

    $count = null;
    $contador = 0; //para saber si es nulo
    //si se ejecuta mysqli_fetch algo, se mueve el puntero de la BD
    $json = "[";
    while($row=mysqli_fetch_assoc($resp)){
        if($contador==0)
            $count = $row[$col];
        $json.= $row[$col].",";
    }

    $json[strlen($json)-1]="]";

    //si está vacío devuelve "null" OJO como cadena
    if($count!=null)
        echo $json;
    else
        echo "null";
?>
