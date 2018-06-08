<?php
//manda todas los id de todas las publicaciones o usuarios en un json
    include "funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);

    $busq = "SELECT id_publicacion FROM publicacion"; //Tooodas las publicaciones
    $resp = mysqli_query($db,$busq);

    $count = null;
    $contador = 0; //para saber si es nulo

    $json = ",";
    while($row=mysqli_fetch_assoc($resp)){
        if($contador==0)
            $count = $row["id_publicacion"];
        $json.= $row["id_publicacion"].",";
    }

    $json[strlen($json)-1]=",";

    //si está vacío devuelve "null" OJO como cadena
    if($count!=null)
        echo $json;
    else
        echo "null";
?>
