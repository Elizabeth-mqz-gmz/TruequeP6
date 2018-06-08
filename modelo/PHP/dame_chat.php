<?php
    //abrir base de datos en index
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    //Datos que se definen para la búsqueda
    $quienEnvio = 1; // Suponemos que es el emisor hasta que entra en la condición de lo contrario
    $usuario = dame_cookie(); //USUARIO QUE ESTÁ ABIERTO EN LA PÁGINA
    $otro = validar($_POST["usuRec"],"",$db); //PERSONA CON LA QUE QUIERE HABLAR
    $personas = 'emisor":"'.$usuario.'","receptor":"'.$otro; //Supunemos que así está el jsson hasta que entre a la condicion de lo contrario

    $busq = "SELECT id_chat FROM chat WHERE id_em='$usuario' and id_rec='$otro';"; //VER SI YA EXISTE EL CHAT CON EL USUARIO COMO EMISOR (emisor = persona que envió el 1er mns)
    $resp = mysqli_query($db,$busq);
    $exist = mysqli_num_rows($resp);
    if($exist==0){ //No existe el chat con usuario como emisor
        $busq = "SELECT id_chat FROM chat WHERE id_em='$otro' and id_rec='$usuario';";
        $resp = mysqli_query($db,$busq);
        $exist = mysqli_num_rows($resp);
        if($exist==0){ // Tampoco existe el chat con usuario como receptor
            $busq = "INSERT INTO chat VALUES "."("."'','$usuario','$otro');";//Hace el chat con usuario como emisor, porque como aún no existe el chat, él envió el 1er mns
            mysqli_query($db,$busq);
            $busq = "SELECT id_chat FROM chat WHERE id_em='$usuario' and id_rec='$otro';"; //Obtiene la query del id chat nuevo
            $resp = mysqli_query($db,$busq);
        }
        else{ //Existe el chat, pero el usuario está registrado como receptor
            $quienEnvio = 0; //Es la condición que se utilizará en js para saber quien envió el mensaje
            $personas= 'emisor":"'.$otro.'","receptor":"'.$usuario; //Se hace el json con los datos al revés
        }
    }
    $id_chat = mysqli_fetch_array($resp)[0]; //Obtiene el id_chat (Ahora sí)
    // echo $id_chat;
    echo '{"chat":"'.$id_chat.'","'.$personas.'","quienEnvio":"'.$quienEnvio.'"}'; //Hace el json y lo manda a js
    mysqli_close($db);

?>
