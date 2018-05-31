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
    //cifrar o decifraar por coordenadas
    //buscar [letra_llave][letra_mensaje] para cifrar
    if($sent==1){
        for($i=0;$i<strlen($tex);$i++)
            if(isset($mat[$strkey[$i]][$tex[$i]]))
                $tex[$i]= $mat[$strkey[$i]][$tex[$i]];
    }
    else if($sent==2){
    //buscar letra cifrada en el arreglo [letra_llave] para decifrar
        for($i=0;$i<strlen($tex);$i++)
            if(array_search($tex[$i],$mat[$strkey[$i]])!="")
                $tex[$i]=array_search($tex[$i],$mat[$strkey[$i]]);

    }
    return htmlentities($tex);
}
?>
