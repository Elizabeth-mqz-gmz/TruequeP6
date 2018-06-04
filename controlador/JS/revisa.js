$(document).ready(function(){
    $("#pass2").on("change",function(){
        contra = $("#pass2").val();
        if($("#pass1").val() == $("#pass2").val()){

          $.ajax({
        			url: 'controlador/PHP/validarPass.php',
        			data:{
        				pass :	contra,
        			},
        			type:'POST',
        			success: function(response){
        					if (response == 'F'){
                        alert('Su contraseña es invalida');
                        regis.reset();
        					}
                  else
                    $("#msj").html("<input class='btn btn-success' class='btn btn-primary btn-l' type='submit'>");
        				}
        	  });
        }
        else
          $("#msj").html("Las contraseñas no coinciden");
    });

    var regex = [/^(31)[6789][0-9]{6}/, /^[A-Z][a-zA-Záéíóú\s]+/, /^[A-Z][a-zA-Záéíóú\s]+/, /^[A-Z][a-zA-Záéíóú\s]+/, /[A-Za-z\d]{6,20}$/];
    var elements = ["num_cta", "nom", "ape_pat", "ape_mat", "user"];

    $("#regis").change((event)=>{
      var dato = event.target.id;
      var aux = elements.indexOf(dato);
      if (aux >= 0){
        let reg = new RegExp (regex[aux]);

        if (reg.test(event.target.value) == true){
          document.getElementById(dato).className = "form-control is-valid";
          document.getElementById(dato).nextSibling.innerHTML="Eso funciona para mi!"
        }
        else{
          document.getElementById(dato).className = "form-control is-invalid";
          document.getElementById(dato).nextSibling.innerHTML="No es correcto";
        }
      }
    });
});
