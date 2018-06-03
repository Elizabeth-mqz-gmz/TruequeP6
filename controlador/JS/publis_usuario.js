$(document).ready(()=>{
    var coo = [];
    coo = document.cookie.split(";");
    var cookie = "usuario";
    for(let v of coo)
        if(v.search(/usuBuscado/)!=-1)
            cookie = v;
    if (cookie != "usuario"){
      var cookieBuscada = cookie.split("=");
      cookie = cookieBuscada[1];
    }
    $.ajax({
    url:"../../modelo/PHP/publis_usuario.php",
    data:{
      perfilUsu : cookie
    },
    type: "POST",
    success:function(response){
        if(response!="null"){
            var publis = [];
            publis = response.split(",");
            publis.pop(); publis.shift();
            for (let v of publis)
                publicacion(v,false,()=>{
                    $("#"+v+" .btn").one("click",()=>{
                        document.cookie = "pub="+v+";max-age=60";
                    });
                });
        }
        else {
          $("#publicaciones").append("<div>Éste usuario aún no ha realizado ninguna publicación");
        }
    }
    });
});
