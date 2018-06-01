$("#enviar").click(()=>{
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
