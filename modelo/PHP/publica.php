<?php
    include "../../controlador/PHP/funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    $publi = $form["menPub"];
    $tipoPerdida = "ropa"; //FALTA saber
    $usuario = 31700002; //FALTA saber

    $busq = "SELECT id_publicacion FROM publicacion ORDER BY id_publicacion DESC";
    $resp = mysqli_query($db,$busq);
    $row = mysqli_fetch_array($resp);
    $id_pub= $row[0]+1;

    echo "$id_pub<br/>";
    //guarda el archivo en ../imagenes_pub/
    $ruta = "../imagenes_pub/";
    $ruta_arch = $ruta.basename($id_pub);
    //toma la extensión del archivo y la concatena
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    $ruta_arch.=".".$tipo;

    //si existen todos los datos necesarios, se guarda en la base de datos
    if(isset($form["menPub"]) && isset($form["tipoPub"])){
        //valida que no exista ya el archivo: imagen
        if(!file_exists($ruta_arch))
            //valida que el archivo se coloque correctamente en el servidor
            if(!move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_arch))
                echo "<br/>ERROR";
            else{
                //guarda la publicación en la base de datos
                $busq = "INSERT INTO publicacion(id_autor,imagen_publi,publicacion) VALUE"."("."'$usuario','$ruta_arch','$publi'".")";
                mysqli_query($db,$busq);

                //si es truque guarda con truque, del contrario con peridia
                if($form["tipoPub"]=="trueque")
                    $busq = "INSERT INTO trueque(id_publi_true) VALUE"."(".$id_pub.")";
                else if($form["tipoPub"]=="perdida")
                    $busq = "INSERT INTO perdida(id_publi_per,tipo_perdida) VALUE"."("."'$id_pub','$tipoPerdida'".")";

                mysqli_query($db,$busq);
            }
    }
    mysqli_close($db);

?>
