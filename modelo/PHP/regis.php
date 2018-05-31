<?php
    include "func.php";
    $datos = array( "num_cta" => $_POST["num_cta"],
      "nom" => $_POST["nom"],
      "ape_pat" => $_POST["ape_pat"],
      "ape_mat" => $_POST["ape_mat"],
      "user" => $_POST["user"],
      "contra" => $_POST["contra"] );

    $hash = sha1($datos["contra"]); //hasheado de contraseña
        echo $hash.'<br/>';
    $valorcillo = false;
     if (preg_match('/^(31)[678][1-9]{6}/',$datos["num_cta"])){
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

        $conex = mysqli_connect('localhost','root','','truequep6');
        mysqli_set_charset($conex,'utf8');
        if(!$conex){
        		echo mysqli_connect_error();
        		echo mysqli_connect_errno();
        		exit();
        	}
        foreach ($datos as $ind => $val) {
            mysqli_real_escape_string($conex, $val);
        }
        $bus = "INSERT INTO usuario (id_usuario, nombre, ape_pat, ape_mat, contra, nomus) VALUES "."("."".$datos["num_cta"].",'".$datos['nom']."','".$datos['ape_pat']."','".$datos['ape_mat']."','".$datos['contra']."','";
        $bus.=$datos['user']."')";
        echo $bus;
        $resp=mysqli_query($conex,$bus);
        mysqli_close($conex);
    }
    else if($valorcillo == false)
        echo 'El registro ha resultado en fracaso';
?>
