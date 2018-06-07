$(document).ready(()=>{
    $("#chat").hide(); //Ocultar el botón del chat y sólo se muestra si el usuario que busca no es él
    var coo = [];
    coo = document.cookie.split(";");
    var cookie = "usuario";
    for(let v of coo)
        if(v.search(/usuBuscado/)!=-1) // ver que exista esa cookie
            cookie = v; //Ahora cookie es != de usuario, se cumple lo de abajo porque sí la encontró
    if (cookie != "usuario"){ //significa que sí la encontró arriba
      var cookieBuscada = cookie.split("=");
      cookie = cookieBuscada[1]; //Agarra el valor de la cookie
    }

    $.ajax({
    url:"../../modelo/PHP/publis_usuario.php",
    data:{
      perfilUsu : cookie //AQUÏ SE PUEDE MANDAR "USUARIO" o un número de cuenta, con eso se valida en php
    },
    type: "POST",
    success:function(response){
        if(response!="null"){
            var publis = [];
            publis = response.split(",");
            publis.pop(); publis.shift(); //Había un problema raro, no sé qué pasaba, pero ésto lo soluciona :), creo que era por las , que mandamos en php
            for (let v of publis)
                publicacion(v,false,()=>{ //Hacer las publicaciones
                    $("#"+v+" .btn").one("click",()=>{
                        document.cookie = "pub="+v+";max-age=60";
                    });
                });
        }
        else {
          if ( cookie != "usuario" ) //Otra vez validar que no sea él mismo jajaja, para mandar el mensaje
            $("#publicaciones").append("<div>Éste usuario aún no ha realizado ninguna publicación</div>");
          else {
            $("#publicaciones").append("<div>Aún no has publicado nada, <a href='../../vista/maquetado/publicar.php'>¡Vamos!</a></div>");
          }
        }
    }
    });

    if ( cookie != "usuario" ){
      var persona =   $("#nombre");
      $("#chat").show(); //Mostrar e "Enviar mensaje"
      $("#chat").on("click",()=>{ //Si le da click se crea la cookie y te redirecciona a chat jiji
          document.cookie = "otro="+cookie+";max-age=10";
          location.href ="../../vista/maquetado/chat.php";
      });
    }
});
