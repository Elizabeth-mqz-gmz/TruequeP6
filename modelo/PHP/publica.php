<?php
//guarda los datos de una publicación en la base de datos
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    $publi = $form["menPub"];

    $usuario = dame_cookie();
    // echo $usuario;
    if(isset($form["tipoPer"])){
        //si es pérdida, definir el tipo
        $tipoPerdida = $form["tipoPer"];
        if(isset($form["numCred"])){
        //guarda notificación en la base de datos, referenciando al este usuario
            $idUsuNot = $form["numCred"];
            $menNot = "El usuario $usuario encontró tu credencial";
            $busq = "INSERT INTO notificacion(id_usu_not,men_not) VALUE"."("."'$idUsuNot','$menNot'".")";
            mysqli_query($db,$busq);
        }
    }


    $busq = "SELECT id_publicacion FROM publicacion ORDER BY id_publicacion DESC";
    $resp = mysqli_query($db,$busq);
    $row = mysqli_fetch_array($resp);
    $id_pub= $row[0]+1;
    // echo "<br/>".$busq;
    // echo "<br/>".$id_pub;
    //guarda el archivo en ../imagenes_pub/
    $ruta = "../imagenes_pub/";
    $ruta_arch = $ruta.basename($id_pub);
    //toma la extensión del archivo y la concatena
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    $ruta_arch.=".".$tipo;

    //si existen todos los datos necesarios, se guarda en la base de datos
    if(isset($form["menPub"]) && isset($form["tipoPub"])){
        //valida que no exista ya el archivo: imagen
        echo $ruta_arch;
        if(!file_exists($ruta_arch)){
            // echo "probar";
            //valida que el archivo se coloque correctamente en el servidor
            if(!move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_arch))
                echo "<br/>ERROR";
            else{
                //guarda la publicación en la base de datos
                $busq = "INSERT INTO publicacion(id_autor,imagen_publi,publicacion) VALUE"."("."'$usuario','$ruta_arch','$publi'".")";
                mysqli_query($db,$busq);
                // echo "<br/>".$busq;
                //si es truque guarda con truque, del contrario con peridia
                if($form["tipoPub"]=="trueque")
                    $busq = "INSERT INTO trueque(id_publi_true) VALUE"."(".$id_pub.")";
                else if($form["tipoPub"]=="perdida")
                    $busq = "INSERT INTO perdida(id_publi_per,tipo_perdida) VALUE"."("."'$id_pub','$tipoPerdida'".")";
                // echo "<br/>".$busq;
                mysqli_query($db,$busq);
            }
        }
    }
    mysqli_close($db);
    header("Location: ../../vista/maquetado/main.php")
?>
