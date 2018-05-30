<?php
    //abrir base de datos en indexs
    $db = mysqli_connect("localhost","root","","truequep6");
    if(!$db){
        echo mysqli_connect_error($db);
        echo mysqli_connect_errno($db);
        exit();
    }
    $form=[];
    foreach($_POST as $i => $v){//funcion validar
        $i = string_tags($i);
        $i = mysqli_real_escape_string($db,$i);
        $v = string_tags($v);
        $v = mysqli_real_escape_string($db,$v);
        $form[$i] = $v;
    }
    $rec = $form["usuRec"];
    $em = $form["usuEm"];
    $mensaje = $form["men"];

    $busq = "SELECT FROM chat WHERE id_rec='$rec' and id_em='$em'";
    $resp = mysqli_query($db,$busq);
    if($resp==null){
        $busq = "SELECT FROM chat WHERE id_rec='$em' and id_em='$rec'";
        $resp = mysqli_query($db,$busq);
    }
    $row = mysqli_fetch_assoc($resp);
    $idChat = $row[0];
    $busq = "SELECT mensaje FROM mensaje WHERE id_chat = '$idChat'";
    $resp = mysqli_query($db,$busq);
    while($row=mysqli_fetch_array($resp))
        echo $row[1]".<br/>";
    mysqli_close($db);

?>
