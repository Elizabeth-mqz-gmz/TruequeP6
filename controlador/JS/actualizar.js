//actualizar.js
//Se utilizan las funciones de revisa js para validar el nombre y contraseña :)
$("#NuevoUsuario").hide();//Ocultar el botón de actualizar
$("#user").on("blur", ()=>{
  let clase = $("#user").attr("class");
  console.log(clase);
  if (clase != "form-control is-invalid")//verificar que el nombre cumpla con las especificaciones
    $("#NuevoUsuario").show();
  else
    $("#NuevoUsuario").hide();
});

$("#NuevoUsuario").on("click", ()=>{//accionar ajax para cambiar el nombre de usuario
  let nombre = $("#user").val();
  console.log("Evento");
  jQuery.ajax({
      url:"../../modelo/PHP/actualizar_nombre.php",
      data:{
          usuario : nombre
      },
      type: "POST",
      success: function(response){
        // console.log(response);
        $("#nuevonomus").modal("hide");
        if(response == "F")
          ModalGlobal("Dato Invalido", "Nombre de usuario incorrecto");
        else
          window.location = "perfil_usuario.php";
        }
  });
});

  $("#novasenha").hide();
  $("#pass2").on("change",function(){
      // contra = $("#pass2").val();
      if($("#pass1").val() == $("#pass2").val()){ //Checa que las contraseñas sean iguales
        contra = $("#pass2").val();
        validar_contra(contra,"../../controlador/PHP/validarPass.php", "novasenha");
      }
      else
        $("#msj").html("Las contraseñas no coinciden"); //Si pass2 no es igual a pass1
  });

$("#enviar").click(()=>{
    $("#alert").remove();
    var usuario = $("#usuario").val();
    var contra = $("#contrasena").val();
    jQuery.ajax({
        url:"../../modelo/PHP/inicio_sesion.php",
        data:{
            id_usuario : usuario,
            contra : contra
        },
        type: "POST",
        success: function(response){
              let n = response;
              if (n == "T"){
                document.getElementById("formIS").reset();
                $("#kk").modal("hide");
                $("#nuevacontra").modal("show");
              }
              else{
                if (n.length == 2){
                  $("#kk").modal("hide");
                  ModalGlobal("Cuidado","No es posible actualizar la información del administrador");
                  }
                else{
                  var alerta = $("<div id = 'alert' class='alert alert-danger' role='alert'>Tu número de cuenta o contraseña no son validos. Por favor inténtalo de nuevo.</div>");
                  alerta.appendTo("#mensaje");
                }
              }
            }
    });
});

$("#novasenha").on("click", ()=>{
  let contra = $("#pass1").val(); //obtener contraseña del input
  // console.log("eveto");
  // console.log(contra);
  jQuery.ajax({
      url:"../../modelo/PHP/actualizar_contrasena.php",
      data:{
          contrasena : contra
      },
      type: "POST",
      success: function(response){
        // console.log(response);
        // $("#pass1").empty();
        // $("#pass2").empty();
        document.getElementById("formContra").reset();
        $("#nuevacontra").modal("hide");
        if (response != "Contrasena")
          ModalGlobal("Éxito", "Tu contraseña ha sido modificada");
        else
          ModalGlobal("Dato Invalido", "Esa contraseña no cumple con las especificaciones");
        }
  });
});
