<?php
//recibe una id publicación y devuelve
//json en forma de arreglo normal, con nomus : comentario
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    $idPub = validar($_POST["idPubli"],"",$db);

    $busq = "SELECT comentario,nomus FROM comentario INNER JOIN usuario ON comentario. id_usu_comen=usuario.id_usuario where id_publi_comen= '$idPub';";
    $resp = mysqli_query($db,$busq);

    $count = "null";
    $contador = 0; //para saber si es nulo
    //si se ejecuta mysqli_fetch algo, se mueve el puntero de la BD
    $json = "[";
    while($row=mysqli_fetch_assoc($resp)){
        if($contador==0)
            $count = $row["nomus"];
        $json.= "{\"nomus\":\"".$row["nomus"]."\",\"comentario\":\"".$row["comentario"]."\"},";
    }

    $json[strlen($json)-1]="]";
    //si está vacío devuelve "null" OJO como cadena
    if($count != "null")
        echo $json;
    else
        echo $count;
 ?>
