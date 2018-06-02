<?php
//recibe una id publicación y devuelve
//json en forma de arreglo normal, con nomus : comentario
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i=> $v){
        $i = validar($i,"",$db);
        $v = validar($v,"",$db);
        $form[$i]=$v;
    }
    $idPub = $form["idPubli"];

    $busq = "SELECT comentario,nomus FROM comentario INNER JOIN usuario ON id_publi_comen='$idPub'";
    $resp = mysqli_query($db,$busq);

    $resp = mysqli_query($db,$busq);

    $count = null;
    $contador = 0; //para saber si es nulo
    //si se ejecuta mysqli_fetch algo, se mueve el puntero de la BD
    $json = "[";
    while($row=mysqli_fetch_assoc($resp)){
        if($contador==0)
            $count = $row["nomus"];
        $json.= "{\"nomus\":\"".$row["nomus"]."\",
                \"comentario\":\"".$row["comentario"]."\"},";

    }

    $json[strlen($json)-1]="]";

    //si está vacío devuelve "null" OJO como cadena
    if($count!=null)
        echo $json;
    else
        echo "null";
 ?>
