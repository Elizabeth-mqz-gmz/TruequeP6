<?php
    include "funciones.php";
    $datos = array( "num_cta" => $_POST["num_cta"],
      "nom" => $_POST["nom"],
      "ape_pat" => $_POST["ape_pat"],
      "ape_mat" => $_POST["ape_mat"],
      "user" => $_POST["user"],
      "contra" => $_POST["contra"] );
    //IMAGEN
    //print_r($_FILES);
    //print_r($_POST);
    $ruta = "../imagenes_per/";
    //toma la extensión del archivo y la concatena
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    if($tipo == "png"){
        $ruta = $ruta.$_FILES["imagen"]["name"];//para guardar debe ser una ruta
        if(!move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta))
            $ruta = "modelo/imagenes_per/default.png";
        $ruta = "modelo/imagenes_per/".$_FILES["imagen"]["name"];//y debemos cambiarla
      }
    else
        $ruta = "modelo/imagenes_per/default.png";

    $hash = sha1("f2wesxdrftgyH3".$datos["contra"]."B6jxddgvhuijwq"); //hasheado de contraseña, con sazonado
    $valorcillo = false;
     if (preg_match('/^(31)[6789][0-9]{6}/',$datos["num_cta"])){
        if (preg_match('/^[A-Z][a-záéíóúA-ZÁÉÍÓÚ\s]{3,30}$/',$datos["nom"])){
            if (preg_match('/^[A-Z][a-záéíóúA-ZÁÉÍÓÚ\s]{3,30}$/',$datos["ape_pat"])){
                if (preg_match('/^[A-Z][a-záéíóúA-ZÁÉÍÓÚ\s]{3,30}$/',$datos["ape_mat"])){
                    if (preg_match('/[A-Za-z\d]{6,30}$/',$datos["user"])){
                            if(!validarPass($datos["contra"]))
                                echo 'La contraseña es inválida';
                            else
                                $valorcillo = true;
                    }
                }
            }
        }
    }

    if($valorcillo == true)
    {
        //CIFRADO
        $datosCif = array();
        foreach($datos as $i => $v){ //Guarda datos cifrados en nuevo array
            $datosCif[$i]=cifrado($datos["num_cta"],$v,1);
        }
        // print_r($datosCif);

        $conex = conexion();
        checar_con($conex);
        foreach ($datos as $i => $v) {
            $datos[$i]=validar($v,"",$conex);
        }
        foreach ($datosCif as $i => $v) {
            $datosCif[$i]=validar($v,"",$conex);
        }
        $busq = "SELECT * FROM usuario WHERE id_usuario = ".$datos["num_cta"]."";
        $unico = mysqli_query($conex,$busq);
        $exist = mysqli_num_rows($unico);
        if($exist == 0){ //REVISA SI EL REGISTRO EXISTE
            $bus = "INSERT INTO usuario (id_usuario, nombre, ape_pat, ape_mat, contra, nomus, imagen) VALUES "."("."".$datos["num_cta"].",'".$datosCif['nom']."','".$datosCif['ape_pat']."','".$datosCif['ape_mat']."','".$hash."','";
            $bus.=$datos['user']."','".$ruta."')";
            //echo $bus;
            $resp=mysqli_query($conex,$bus);
        }
        mysqli_close($conex);
    }
    else if($valorcillo == false)
        echo 'El registro ha resultado en fracaso';
   header("Location: ../../index.php");
?>
