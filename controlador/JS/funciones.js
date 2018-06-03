function comentario(idPub){
  var comentarios;
    $.ajax({
        url:"../../modelo/PHP/dame_comen.php",
        data:{
            idPubli:idPub
        },
        type: "POST",
        success: function(response){
          console.log(response);
          if (response != "null"){
            comentarios = JSON.parse(response);
            for (let i in comentarios)
              $("#contenedorComen").append(comentarios[i].nomus+"dice: <br />"+comentarios[i].comentario+"<br/>");
          }
        }
    });
    console.log(idPub);
    return;
}

function publicacion(idPub,individual,cb){
//individual false, muestra boton, es para ver publicaciones
//individual true, es el modo de comentarios y reacciones
    $.ajax({
        url:"../../modelo/PHP/publicacion.php",
        //pide una publicación con el id_publicacion = idPub
        data:{
            idPubli: idPub
        },
        type:"POST",
        //genera los elementos html con clases bootstrap, de la publicacion
        success: function(response){
            //console.log(response);

            //el php regresa un json
            var publi = JSON.parse(response);
            //clases de bootstrap
            let divGeneral = "<div id='"+idPub+"' class='card'>";
            let imgDiv2 = "<img class='card-img-top'/><div class='card-body'>";
            let texto = "<h5 class='card-title'></h5><div class='den'><img src='../recursos/den.png'/></div><p class='card-text'></p>";
            let boton;
            if(individual)
                boton = "<div class='reac'><img src='../recursos/nmp.png'/ class='Me vale'><img src='../recursos/md.png'/ class='Jajajaja'><img src='../recursos/mmm.png' class='Mmm'/></div>";
            else
                boton = "<a href='publicacion.php' class='btn btn-primary'>Ver publicación</a>";
            let estado = "</div><h6></h6><span>Me interesa<span></div>";

            //contenedor puede ser cualquier caja IMPORTANTE
            $("#contenedorPubli").append(divGeneral+imgDiv2+texto+boton+estado);
            $("#"+idPub+">div>h5").text(publi.autor);
            $("#"+idPub+">div>p").text(publi.publicacion);

            //OJO no agregar o quitar clases de img, IMPORTANTE para reacciones
            $("#"+idPub+">img").attr("src","../../modelo/PHP/"+publi.imagen);
            $("#"+idPub+">h6").text(publi.estado);

            if(publi.estado=="inconcluso")
                $("#"+idPub+">h6").css("color","red");//cambiar a color elegido
            else if(publi.estado=="terminado")
                $("#"+idPub+">h6").css("color","green");//cambiar a color elegido

            //si el usuario actual ya reaccionó se pone naranja la reacción
            if(publi.usuReac!="null")
                if(publi.usuReac=="Me vale")//Me vale, causa error por tener espacio, corregido
                    $("#"+idPub+" .reac>img:first-child").css("border-color","#E98836");
                else
                    $("."+publi.usuReac).css("border-color","#E98836");

            if(publi.esAutor=="true"){
                //poner borde si es autor
                $("#"+idPub+">h6").css("border","1px solid #1919BEBE");

                //al darle click al estado, este se cambia y actualiza en la base de datos
                $("#"+idPub+">h6").on("click",()=>{
                    let est;
                    //cambia color, texto y valor del POST
                    if($("#"+idPub+">h6").css("color")=="rgb(255, 0, 0)"){
                        est = "terminado";
                        $("#"+idPub+">h6").text(est);
                        $("#"+idPub+">h6").css("color","green");
                    }
                    else{
                        est = "inconcluso";
                        $("#"+idPub+">h6").text(est);
                        $("#"+idPub+">h6").css("color","red");
                    }
                    //actualiza en la BD si está inconcluso o terminado la publicación
                    $.ajax({
                        url:"../../modelo/PHP/concluye_pub.php",
                        data:{
                            idPubli: idPub,
                            estado: est
                        },
                        type: "POST"
                    });

                });
            }
            //si la denuncia es 0, muestra la imagen, del contrario no
            //al darle click en la imagen de denuncia, cambia el estado
            if(publi.denuncia == "0")
                $("#"+idPub+" .den").on("click",()=>{
                    $("#"+idPub+" .den").hide();
                    $.ajax({
                        url:"../../modelo/PHP/denuncia.php",
                        data:{
                            idPubli: idPub,
                        },
                        type: "POST"
                    });
                });
            else
                $("#"+idPub+" .den").hide();

            //manda notificación a la BD de que al usuario le interesa esa publicación
            $("#"+idPub+">span").on("click",()=>{
                $.ajax({
                    url:"../../modelo/PHP/me_interesa.php",
                    data:{
                        idPubli:idPub
                    },
                    type: "POST",
                    success: function(){
                        $("#"+idPub+">span").css("color","green");
                    }
                });
            });

            //para cuando está con comenatrios y reacciones, se ejecute un callback
            //para el botón se agrega el evento click
            return cb();
        }
    });
}

function saca_publi(tipo){
    $.ajax({
        url:"../../modelo/PHP/dame_publis.php",
        data:{
            tipoPubli: tipo
        },
        type: "POST",
        success:function(response){
            if(response!="null"){
                var publis = [];
                publis = JSON.parse(response);
                for (let v of publis)
                    publicacion(v,false,()=>{
                        $("#"+v+" .btn").one("click",()=>{
                            document.cookie = "pub="+v+";max-age=60";
                        });
                    });
            }
        }
    })
    return;
}

function ordenar_eventos(respuesta){
  let ayu= [], ayu2=[];
  for (i in respuesta){
    respuesta[i].fecha = new Date (respuesta[i].fecha).getTime();//convertir la fecha para poder hacer una comparación
    ayu[i] = respuesta[i].fecha;
    }
  ayu=ayu.sort(function(a,b){return a+b});
  for (i in ayu){
    for (ind in respuesta){
      if (ayu[i] == evento[ind].fecha)
        ayu2[i] = evento[ind];
      }
    }
  evento = ayu2;
}

function hacer_calendario (respuesta) {
  $("<div id='calendario'>").appendTo("#evento");

  for ( i in respuesta){
    respuesta[i].fecha = new Date(respuesta[i].fecha);
    mes = parseInt(respuesta[i].fecha.getMonth());
    mes ++;
    dia = respuesta[i].fecha.getDate() +"/"+ mes.toString() + "/"+ respuesta[i].fecha.getFullYear();
    hora = respuesta[i].fecha.getHours() + ":" + respuesta[i].fecha.getMinutes();
    let fecha = "<div >El día "+dia+" en el horario "+hora;//mientras no está súper definido como se mostrará el calendario, así no está todo muy amontonado
    let personas = " se encontrarán "+respuesta[i].id_em+" y "+respuesta[i].id_rec;
    let evento = "<h4>"+respuesta[i].tipo_even+"</h4>";
    let lugar = " en "+respuesta[i].lugar+"</div>";
    $("<div class='dropdown-item disabled'>"+ evento + fecha + personas +  lugar +"</div>").appendTo("#calendario");
    $("<div class='dropdown-divider'></div>").appendTo("#calendario");
  }
  $("</div>").appendTo("#evento");
}

function obtener_calendario (ruta){
  let request = new XMLHttpRequest();
  request.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      evento = JSON.parse(this.response);
      ordenar_eventos(evento);
      hacer_calendario(evento);
    }
  };
  request.open("POST", ruta , true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send();
}

function eliminar_eventos(){
  $(document).ready(function(){
    $("#calendario").remove();
  });
}
