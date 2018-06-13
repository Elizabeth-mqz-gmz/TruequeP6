<?php
  include 'funciones.php';
  $db = conexion(); //Conectar con la base de datos
  checar_con($db);

  $publi = $_POST["idPubli"]; //Recibir el id de la publicación
  $reacciones = [
    "MeVale" => 0,
    "Jajajaja" => 0,
    "Mmm" => 0
  ];
  $json = "{";
  $resp = mysqli_query($db,"SELECT tipo_reac FROM reaccion WHERE id_publi_reac = $publi;"); //Traer todas las reacciones de la publicación

  while ($row = mysqli_fetch_assoc($resp))
      foreach ($reacciones as $i => $v) { //Checar lo que sale de row, para sumar en esa casilla de $reacciones
          if($i =="MeVale")
            $checar = preg_match("/Me Vale/",$row["tipo_reac"]);
          else
            $checar = preg_match("/$i/",$row["tipo_reac"]);
          // echo $checar."<br />";
          if ($checar == 1)
              $reacciones[$i]++;
      }

  foreach ($reacciones as $i => $v)  //Concatenar el json
      $json .= "\"$i\":\"$v\",";

  $json [strlen($json)-1] = "}";
  echo $json;
?>
