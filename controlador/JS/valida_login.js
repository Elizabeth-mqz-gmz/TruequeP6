$("#enviar").click(()=>{
    $("#alert").remove();
    var usuario = $("#usuario").val();
    var contra = $("#contrasena").val();
    jQuery.ajax({
        url:"modelo/PHP/inicio_sesion.php",
        data:{
            id_usuario : usuario,
            contra : contra
        },
        type: "POST",
        success: function(response){
            let n = response;
            console.log(n);
            if (n.length == 2){
              //cookie que indica que eres un administrador
              window.location="vista/maquetado/main.php";
            }
            else{
              if (n == "T"){
                window.location="vista/maquetado/main.php";
              }
              else{
              var alerta = $("<div id = 'alert' class='alert alert-danger' role='alert'>Tu número de cuenta o contraseña no son validos. Por favor inténtalo de nuevo.</div>");
              alerta.appendTo("#mensaje");
              }
            }
        }
    });
});
