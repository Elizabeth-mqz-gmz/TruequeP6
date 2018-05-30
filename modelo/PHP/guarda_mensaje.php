<?php
    //abrir base de datos en indexs
    $db = mysqli_connect("localhost","root","","truequep6");
    if(!$db){
        echo mysqli_connect_error($db);
        echo mysqli_connect_errno($db);
        exit();
    }
    /*$form=[];
    foreach($_POST as $i => $v){//funcion validar
        $i = string_tags($i);
        $i = mysqli_real_escape_string($db,$i);
        $v = string_tags($v);
        $v = mysqli_real_escape_string($db,$v);
        $form[$i] = $v;
    }
    $rec = $form["usuRec"];
    $em = $form["usuEm"];
    $mensaje = $form["men"];*/
    $em = "317000002";
    $rec =  "317000001";
    $men = "prueba";

    $busq = "SELECT id_chat FROM chat WHERE id_rec='$rec' and id_em='$em'";
    $resp = mysqli_query($db,$busq);
    if($resp==null){
        $busq = "SELECT id_chat FROM chat WHERE id_rec='$em' and id_em='$rec'";
        $resp = mysqli_query($db,$busq);
        echo "<br/> estoy en null";
        if($resp==null){
            $busq = "INSERT INTO chat VALUE"."("."\"\",$rec,$em".")";
            $resp = mysqli_query($db,$busq);
            $busq = "SELECT id_chat FROM chat WHERE id_rec='$rec' and id_em='$em'";
            $resp = mysqli_query($db,$busq);
            echo "<br/> creo el chat";
        }
    }

    $row = mysqli_fetch_array($resp);
    print_r($row);
    $idChat = $row[0];
    echo "$idChat<br/>$men";
    $busq = "INSERT INTO mensaje VALUE"."("."'a','$men','$idChat'".")";
    mysqli_query($db,$busq);
    mysqli_close($db);
?>
