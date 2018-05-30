<?php
  //calendario.html
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  //checar_con($bd);
  $queryEvento = array(
    "SELECT fecha, tipo_even, lugar, id_em, id_rec FROM ",
    "usuario INNER JOIN chat ON usuario.id_usuario = chat.id_rec OR usuario.id_usuario = chat.id_em ",
    "INNER JOIN evento ON evento.id_chat = chat.id_chat WHERE id_usuario = 317341612 AND evento.fecha <= 20020211"
  ); //facilitar leer query. Lo que hace es buscar los datos escenciales para mostrar el evento uniendo las tablas usuario, evento y chat donde el emisor o receptor pude ser el usuario.

  $datos = array("id_em", "id_rec");

  $resp = mysqli_query($bd, $queryEvento[0].$queryEvento[1].$queryEvento[2]);
  while($ayu = mysqli_fetch_assoc($resp)){//No sabemos quienes van a ir
    forEach ($datos as $val ){
      $queryUsuario = "SELECT nomus FROM usuario WHERE \"$ayu[$val]\" = id_usuario";
      $resp2 = mysqli_query($bd, $queryUsuario);
      $asistente = mysqli_fetch_assoc($resp2 );
      $ayu[$val] = $asistente["nomus"]; //cambia id_cuenta por nomus
    }
    echo "{'fecha':'".$ayu["fecha"]."','tipo_even':'".$ayu["tipo_even"]."','persona1':'".$ayu["id_em"]."','persona2':'".$ayu["id_rec"]."'},";
  }

  mysqli_close($bd);
?>
