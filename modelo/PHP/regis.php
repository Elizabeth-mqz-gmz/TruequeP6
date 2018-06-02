<?php
    include "funciones.php";
    $datos = array( "num_cta" => $_POST["num_cta"],
      "nom" => $_POST["nom"],
      "ape_pat" => $_POST["ape_pat"],
      "ape_mat" => $_POST["ape_mat"],
      "user" => $_POST["user"],
      "contra" => $_POST["contra"] );
    //IMAGEN
    // print_r($_FILES);
    $ruta = "../imagenes_per/";
    //toma la extensión del archivo y la concatena
    $tipo = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
    if($tipo == "png")
        $ruta = $ruta.$_FILES["imagen"]["name"];
    else
        $ruta = "modelo/imagenes_per/default.png";

    $hash = sha1("f2wesxdrftgyH3".$datos["contra"]."B6jxddgvhuijwq"); //hasheado de contraseña, con sazonado
    $valorcillo = false;
     if (preg_match('/^(31)[678][0-9]{6}/',$datos["num_cta"])){
        if (preg_match('/^[A-Z][a-záéíóú]+/',$datos["nom"])){
            if (preg_match('/^[A-Z][a-záéíóú]+/',$datos["ape_pat"])){
                if (preg_match('/^[A-Z][a-záéíóú]+/',$datos["ape_mat"])){
                    if (preg_match('/[A-Za-z\d]{6,20}$/',$datos["user"])){
                            if(!validarPass($datos["contra"]))
                                echo 'La contraseña es inválida';
                            else
                                $valorcillo = true;
                    }
                    else
                        echo 'El nombre de usuario ('.$datos["user"].') es inválido';
                }
                else
                        echo 'El apellido materno ('.$datos["ape_mat"].') es inválido';
            }
            else
                    echo 'El apellido paterno ('.$datos["ape_pat"].') es inválido';
        }
        else
                echo 'El nombre ('.$datos["nom"].') es inválido';
    }
    else
            echo 'El número de cuenta ('.$datos["num_cta"].') es inválido';

    if($valorcillo == true)
    {
        //CIFRADO
        $datosCif = array();
        foreach($datos as $i => $v){ //Guarda datos cifrados en nuevo array
            $datosCif[$i]=cifrado("pUeE",$v,1);
        }
        // print_r($datosCif);
        //COOKIE
        //$usu = cifrado("pUeE","usuario",1);
        //setcookie($usu,$datosCif["num_cta"],time()+3600*24*30,"/"); //Vida de 1 mes.

        $conex = mysqli_connect('localhost','root','','truequep6');
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
        else{
            echo "Ya existe un registro como este";
        }
        mysqli_close($conex);
    }
    else if($valorcillo == false)
        echo 'El registro ha resultado en fracaso';
  //  header("Location: ../../index.php");
?>
