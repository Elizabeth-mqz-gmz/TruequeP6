$("#enviar").click(()=>{
<<<<<<< HEAD
    var usuario = $("#num_cta").value;
    var contraseña = $("#contra").value;
    $.ajax({
        url:"../../modelo/PHP/valida_login.php",
        data:{
            usuario : usuario,
            contraseña : contraseña
        },
        type: "POST",
        success: function(response){
            console.log(response);
        }
    });
  }
)
=======
    $("#alert").remove();
    var usuario = $("#num_cta").val();
    var contraseña = $("#pass").val();
    jQuery.ajax({
        url:"../../modelo/PHP/inicio_sesion.php",
        data:{
            id_usuario : usuario,
            contra : contraseña
        },
        type: "POST",
        success: function(response){
            let n = response;
            if (n.length == 2){
              //cookie que indica que eres un administrador
              window.location="index_pru.html";
            }
            else{
              if (n == "T"){
                window.location="index_pru.html";
              }
              else{
              var alerta = $("<div id = 'alert' class='alert alert-danger' role='alert'>Tu número de cuenta o contraseña no son validos. Por favor intentalo de nuevo.</div>");
              alerta.appendTo("#mensaje");
              }
            }
        }
    });
});
>>>>>>> origin/PerfilAdmi
