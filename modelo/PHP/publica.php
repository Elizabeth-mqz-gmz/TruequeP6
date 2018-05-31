<?php
    include "../../controlador/PHP/funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    $publi = $form["menPub"];
    $tipoPerdida = "ropa"; //FALTA saber
    $busq = "SELECT id_publicacion FROM publicacion order id_publicacion Desc";
    $resp = mysqli_query($db,$busq);
    $row = mysqli_fetch_array($resp);
    $id_pub= $row[0]+1;
    $usuario = 31700002;

    //guarda el archivo en ../imagenes_pub/
    $ruta = "../imagenes_pub/";
    $ruta_arch = $ruta.basename($id_pub);
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    $ruta_arch.=".".$tipo;
    if(!file_exists($ruta_arch))
        if(!move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_arch)){
            echo "<br/>ERROR";

    $busq = "INSERT INTO publicacion(id_autor,image_publi,publicacion) VALUE"."("."$usuario,$ruta_arch,$publi".")";
    mysqli_query($db,$busq);

    if($form["tipoPub"]=="trueque")
        $busq = "INSERT INTO trueque(id_publi_true) VALUE"."(".$id_pub.")";
    else if($form["tipoPub"]=="perdida")
        $busq = "INSERT INTO trueque(id_publi_per,tipo_perdida) VALUE"."("."$id_pub,$tipoPerdida".")";
    mysqli_query($db,$busq);
    mysqli_close($db);

?>
