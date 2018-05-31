<?php
    include "../../controlador/PHP/funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    
    $ruta = "../imagenes_pub/";
    $id_pub=5;
    $ruta_arch = $ruta.basename($id_pub);
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    $ruta_arch.=".".$tipo;
    if(!file_exists($ruta_arch))
        if(!move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_arch)){
            echo "<br/>ERROR";

?>
