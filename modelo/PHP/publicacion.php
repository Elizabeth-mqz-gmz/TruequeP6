<?php
    include "../../controlador/PHP/funciones.php";
    $db = mysqli_connect("localhost","root","","truequep6");
    checar_con($db);
    $form = [];
    foreach($_POST as $i => $v){
        validar($i,"",$db);
        validar($v,"",$db);
        $form[$i] = $v;
    }
    $idPubli = $form["idPubli"];
    $consul = "SELECT * FROM publicacion WHERE id_publicacion='$idPubli'";
    $resp = mysqli_query($db,$consul);
    $row = mysqli_fetch_assoc($resp);
    $usu = $row["id_autor"];
    $consul = "SELECT nomus FROM usuario WHERE id_usuario='$usu'";
    $re = mysqli_query($db,$consul);
    $regis =  mysqli_fetch_array($re);
    $nomUs = $regis[0];
    if($row["denuncia_p"]!=1){
        $json = "{
            \"autor\":\"".$nomUs."\",
            \"estado\":\"".$row["estado"]."\",
            \"imagen\":\"".$row["imagen_publi"]."\",
            \"publicacion\":\"".$row["publicacion"]."\"
        }";
        echo $json;
    }

?>
