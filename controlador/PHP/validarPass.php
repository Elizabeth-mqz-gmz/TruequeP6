<?php
	$pass = $_POST["pass"];
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
				  if(preg_match($regex2, $pass)){
					$error++;
					}
				}
		}
		if (preg_match($regex, $pass)==0 || $error>0)
			echo "F";
		else
			echo "T";
