$(document).ready(function(){
  $("#contraRevisa").hide();
    $("#pass2").on("change",function(){
        // contra = $("#pass2").val();
        if($("#pass1").val() == $("#pass2").val()){ //Checa que las contraseñas sean iguales
          var contra = $("#pass2").val();
          validar_contra(contra, 'controlador/PHP/validarPass.php', "contraRevisa");
        }
        else
          $("#msj").html("Las contraseñas no coinciden"); //Si pass2 no es igual a pass1
    });

    var regex = [/^(31)[6789][0-9]{6}/, /^[A-Z][a-záéíóúA-ZÁÉÍÓÚ\s]{3,30}$/, /^[A-Z][a-záéíóúA-ZÁÉÍÓÚ\s]{3,30}$/,
     /^[A-Z][a-záéíóúA-ZÁÉÍÓÚ\s]{3,30}$/, /[A-Za-z\d]{6,30}$/];
    var elements = ["num_cta", "nom", "ape_pat", "ape_mat", "user"];

    $("#regis").change((event)=>{ //En el elemento que esté cambiando dentro del form
      var dato = event.target.id; //Obtiene el ID del elemento
      var aux = elements.indexOf(dato); //Busca ese ID en el array, y devuelve su índice
      if (aux >= 0){
        let reg = new RegExp (regex[aux]); //Índice equivalente en el array de regex
        // console.log(dato);
        if (reg.test(event.target.value) == true){ //Si hace match
          document.getElementById(dato).className = "form-control is-valid";
          document.getElementById(dato).nextElementSibling.innerHTML="Eso funciona para mí!"
          document.getElementById(dato).nextElementSibling.style.color="green";
        }
        else{
          document.getElementById(dato).className = "form-control is-invalid"; //Si falla
          document.getElementById(dato).nextElementSibling.innerHTML="No es correcto";
          document.getElementById(dato).nextElementSibling.style.color="red";
        }
      }
    });
});
