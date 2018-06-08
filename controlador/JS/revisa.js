$(document).ready(function(){
  $("#enviarRegis").hide();
    $("#pass2").on("change",function(){
        // contra = $("#pass2").val();
        if($("#pass1").val() == $("#pass2").val()){ //Checa que las contraseñas sean iguales
          contra = $("#pass2").val();
          $.ajax({
        			url: 'controlador/PHP/validarPass.php',
        			data:{
        				pass :	contra,
        			},
        			type:'POST',
        			success: function(response){
        					if (response == 'F'){ //Eso manda PHP cuando la contraseña está mal
                        alert('Su contraseña es invalida');
                        $("#pass1").val("");
                        $("#pass2").val("");
                        $("#enviarRegis").hide();
        					}
                  else
                      $("#enviarRegis").show();
        				}
        	  });
        }
        else
          $("#msj").html("Las contraseñas no coinciden");
    });

    var regex = [/^(31)[6789][0-9]{6}/, /^[A-Z][a-zA-Záéíóú\s]+{3,30}$/, /^[A-Z][a-zA-Záéíóú\s]+{3,30}$/,
     /^[A-Z][a-zA-Záéíóú\s]+{3,30}$/, /[A-Za-z\d]{6,30}$/];
    var elements = ["num_cta", "nom", "ape_pat", "ape_mat", "user"];

    $("#regis").change((event)=>{ //Checar cuando cambia
      var dato = event.target.id; //El id es el dato que se está ingresando, no el valor, sólo el nombre
      var aux = elements.indexOf(dato); //Los índices coinciden en "regex" y "elements"
      if (aux >= 0){ //Checar que sea de los valores que se tienen que validar
        let reg = new RegExp (regex[aux]);

        if (reg.test(event.target.value) == true){ //Chechar que cumpla con la regex
          document.getElementById(dato).className = "form-control is-valid";
          document.getElementById(dato).nextSibling.innerHTML="Eso funciona para mí!"
        }
        else{
          document.getElementById(dato).className = "form-control is-invalid";
          document.getElementById(dato).nextSibling.innerHTML="No es correcto";
        }
      }
    });
});
