<?php
function validar ($pal,$regex,$conex){//Esta función recibe una palabra y una regex
      $pal=strip_tags($pal); //quitar las etiquetas
      $pal=mysqli_real_escape_string($conex,$pal); //quitar los comandos sql
      if ($regex != ""){
        $val=preg_match($regex,$pal); //checar la coincidencia
        if ($val==1)
          return $pal; //coincide con la regex, devuelve la cadena validada y segura
        else
          return false; //regresa falso porque no cumple con la regex
      }
      else
          return $pal;
}

function checar_con($conex){//revisa conexión escribe en pantalla si hay error
    mysqli_set_charset($conex,"utf8");
    if(!$conex){
		echo mysqli_connect_error();
		echo mysqli_connect_errno();
		exit();
	}
    return;
}

function cifrado($llave,$tex,$sent){
    $i=0;
    $strkey = "";
    $mat = [];

    $llave= preg_replace("/[^ -~]/","",$llave);
    $n=strlen($llave);
    $llave = hash("crc32b",$llave);
    do{
        $strkey.=$llave[$i++];
        if($i>strlen($llave)-1)
            $i=0;
    }while(strlen($strkey)!=strlen($tex));
    //crear matriz associativa con desfase de la longitud de la $llave
    //de ASCII imprimible
    for($mod=0;$mod<$n;$mod++)
       for($i=0;$i<95;$i++)
           for($j=0;$j<95;$j++){
               if($j%$n==$mod){
                   $char = (($j+$i)%95)+32;
                   $mat[chr($i+32)][chr($j+32)]= chr($char);
               }
           }
    //cifrar o descifraar por coordenadas
    //buscar [letra_llave][letra_mensaje] para cifrar
    if($sent==1){
        for($i=0;$i<strlen($tex);$i++)
            if(isset($mat[$strkey[$i]][$tex[$i]]))
                $tex[$i]= $mat[$strkey[$i]][$tex[$i]];
    }
    else if($sent==2){
    //buscar letra cifrada en el arreglo [letra_llave] para descifrar
        for($i=0;$i<strlen($tex);$i++){
            if(array_search($tex[$i],$mat[$strkey[$i]])!="")
                $tex[$i]=array_search($tex[$i],$mat[$strkey[$i]]);
        }
    }
    return strip_tags($tex);
}
function dame_publicacion($idPubli,$db){
//recibe in id_publicacion para sacar todos sus datos
//devuelve un json

    //slecciona todo sobre esa publicación
    //la imagen se guarda con la ruta de ../imagenes_pub/ejemplo.jpg
    $consul = "SELECT * FROM publicacion WHERE id_publicacion='$idPubli'";
    $resp = mysqli_query($db,$consul);
    $row = mysqli_fetch_assoc($resp);

    //sabiendo el id_autor(número de cuenta), busca su nombre de usuario
    $usu = $row["id_autor"];
    $consul = "SELECT nomus FROM usuario WHERE id_usuario='$usu'";
    $re = mysqli_query($db,$consul);
    $regis =  mysqli_fetch_array($re);
    $nomUs = $regis[0];

    //si no hay denuncia genera un json para el ajax de publicacion.js
    if($row["denuncia_p"]!=1){
        $json = "{
            \"autor\":\"".$nomUs."\",
            \"estado\":\"".$row["estado"]."\",
            \"imagen\":\"".$row["imagen_publi"]."\",
            \"publicacion\":\"".$row["publicacion"]."\"
        }";
        return $json;
    }
    else
        return null;
}
function validarPass($contra)
{
	$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`~!@$%^#*()_+\-={}|\[\]\:?,.\/])([A-Za-z\d`~!@$%^#*()_+\-={}|\[\]\:?,.\/]){8,20}$/";
	$teclado = [
		["q","w","e","r","t","y","u","i","o","p"],
		["a","s","d","f","g","h","j","k","l"],
		["z","x","c","v","b","n","m"]
	];
	$i=0;
	for($x=48; $x<=	57; $x++){ //Numeración 1,2,3...
				$teclado[3][$i] = chr($x);
				$i++;
	}
	$i=0;
	for($x=97; $x<=	122; $x++){//Letras Abecedario
				$teclado[4][$i] = chr($x);
				$i++;
	}
	$error=0;
	for ($i=0; $i<5; $i++) { //Recorriendo el arreglo teclado
		$limit = count($teclado[$i])-3;
			for($n=0; $n<$limit ; $n++)
			{
				$regex2= "/(".$teclado[$i][$n].$teclado[$i][$n+1].$teclado[$i][$n+2].")/i";
			  if(preg_match($regex2, $contra)){
				$error++;
				}
			}
	}
	if (preg_match($regex, $contra)==0 || $error>0){
		// echo "F";
		return false;
	}
	else{
		// echo "T";
		return true;
	}

}
?>
