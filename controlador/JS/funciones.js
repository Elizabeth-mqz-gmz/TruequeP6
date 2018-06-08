function comentario(idPub){  //Obtener todos los comentarios de la publicación que recibe como argumento
  var comentarios;
    $.ajax({
        url:"../../modelo/PHP/dame_comen.php",
        data:{
            idPubli:idPub
        },
        type: "POST",
        success: function(response){
          // console.log(response);
          if (response != "null"){ //Que sí haya comentarios
            comentarios = JSON.parse(response);
            for (let i in comentarios) //Los va agregando
                  $("#contenedorComen").append("<div class='denc'>"+comentarios[i].nomus+" dice: "+comentarios[i].comentario+"</div>");
          }
          else
            $("#contenedorComen").append("<div>Ésta publicación aún no tiene comentarios</div>");
        }
    });
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
            //let texto = "<h5 class='card-title'></h5><div class='den' ><img src='../recursos/den.png'/></div><p class='card-text'></p>";
            let texto = "<h5 class='card-title'></h5><div class='den' data-toggle='modal' data-target='#denuncia'><img src='../recursos/den.png'/></div><p class='card-text'></p>";
            //con MODAL
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
                $("#"+idPub+">h6").css("border","1px solid #19BEBE");

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
            /*if(publi.denuncia == "0")
                $("#"+idPub+" .den").on("click",()=>{
                    $("#"+idPub+" .den").hide();
                    // console.log($("#"+idPub+" .den"));
                    let denuncia = prompt("Ingresa denuncia: ");
                    $.ajax({
                        url:"../../modelo/PHP/denuncia.php",
                        data:{
                            idPubli: idPub,
                            motivo: denuncia,
                        },
                        type: "POST"
                    });
                });*/
                 if(publi.denuncia == "0") //con MODAL
                     $("#"+idPub+" .den").on("click",()=>{
                         $("#"+idPub+" .den").hide();
                         $("#envia").on("click",()=>{
                             // console.log("hola");
                             var denun = $(":selected").val();//obtiene el valor del select
                             //console.log(denun);
                             $.ajax({
                               url:"../../modelo/PHP/denuncia.php",
                               data:{
                                 idPubli: idPub,
                                 motivo : denun,
                               },
                               type: "POST",
                               success: function(response){
                 					           // console.log(response);
                                   }
                              });
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

function saca_publi(tipo){ //Sacar las publicaciones, dependiedno de si quieres trueque o pérdida
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
  ayu=ayu.sort(function(a,b){return a-b});
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

//Funciones chat

function mens(mens){
    if(mens == null) //Aún no han hablado jajajaj, eso significa que en la bd el usuario es ==1 en el atributo emisor
      $(chat).html($(chat).html()+"<br/>Saluda a "+recNomus+"!<br />");
    else{
      mensajes = JSON.parse(mens);
      for (var i in mensajes){
        if (datos.quienEnvio == mensajes[i].emisor) //SIgnifica que la persona mandó en mensaje
            $(chat).append("Tú: "+mensajes[i].mensaje+"<br/>");
        else
            $(chat).append(recNomus+":"+mensajes[i].mensaje+"<br/>");
      }
      ultimoMen = mensajes[mensajes.length-1].idMen; //Obtener el último id para hacer la búsqueda en la bd cuando quiera ver los nuevos mensajes
    }
    $("#enviar").on("click",()=>{
        var mensaje = $("#mensaje").val();
        if(mensaje!="")
            $.ajax({
                url:"../../modelo/PHP/guarda_mensaje.php",
                data:{
                    chat : datos.chat, //EL id del Chat
                    men : mensaje,
                    envia : datos.quienEnvio, //Puede ser 0 o 1, dependiendo de si el usuario es el emisor en la tabla chat
                    llave : llave
                },
                type: "POST",
                success: function(response){ //Ya que se guardó el mensaje
                    $("#mensaje").val(""); //Limpiar el imput
                    $(chat).append("Tú: "+mensaje+"<br/>"); //Agregarlo al html
                }
            });
    });
    $("#actu").on("click",()=>{
        $.ajax({
            url:"../../modelo/PHP/dame_mens.php",
            data:{
                busq :"SELECT id_men,mensaje,emisor FROM mensaje where id_chat ='"+datos.chat+"' AND id_men >'"+ultimoMen+"';", //Checar que no esté guardado en el html ya, o sea que no se haya sacado de la bd
                llave : llave
            },
            type: "POST",
            success: function(response){
                if(response != ""){ //Manda "" cuando no hay nuevos mensajes
                    // console.log(response);
                    let nuevosMen = JSON.parse(response);
                    for (var i in nuevosMen)
                        if (datos.quienEnvio != nuevosMen[i].emisor){ //Checar que el mensaje nuevo que llegó no lo haya mandado el usuario
                            // console.log(mensajes);
                            $(chat).append(recNomus+":"+nuevosMen[i].mensaje+"<br/>");// Escribirlo en el html
                            mensajes.push(nuevosMen[i]); //Agregarlo al array de mensajes
                        }
                    ultimoMen = mensajes[(mensajes.length)-1].idMen; //GUardar el último mensaje para que no se repitan
                }
            }
        });
      });
    return;
}

function datos_chat(cb){
    $.ajax({
        url:"../../modelo/PHP/dame_chat.php", //Obtener el id del chat de la conversación
        data:{
            usuEm : usuario,
            usuRec : receptor //Id's de las personas para hacer la búsqueda
        },
        type: "POST",
        success: function(response){
            datos = JSON.parse(response);
            if (datos.quienEnvio == 0) //Saber si el usuario fue el primero en enviar el mensaje, para voltear la llave del cifrado
                llave = recNomus+usuNomus;
            return cb(datos.chat); //Ahora obtener los mensajes
        }
    });
}

function valdt ()//validar la fecha
{
  //obtener valores del input para validar
  //descompone el valor convirtiendolas en variables para poder realizar la validación
  let fechaFE = document.getElementById("fechaFE").value; //obtener los valores
  let horaFE = document.getElementById("horaFE").value;//por más que intenté ocn jquery no lo ocnseguí pero igual sirve
  fecha = fechaFE.split("-");
  hora = horaFE.split(":");
  //console.log(fecha);
  //console.log(fecha);
  if(parseInt(fecha[0])>2017 && parseInt(fecha[1])<13&&parseInt(fecha[1])>0 && parseInt(fecha[2])<32&&parseInt(fecha[2])>0 && parseInt(hora[0])<25&&parseInt(hora[0])>=0 && parseInt(hora[1])<61&&parseInt(hora[1])>=0 ){
    return fechaFE + " " + horaFE;//concatenar fecha y hora
  }
  else{
    ModalGlobal("Dato incorrecto","Ingresaste un dato de la fecha de forma incorrecta, inténtalo de nuevo" );
    return 'loser';//no se cumplió la validación
  }
}


function mostrar_chats(allChats) {
  $("#verChats").children("li").empty(); //Para que sólo los muestre una vez
  if(allChats!= ""){ //Validar qu etenga chats
    objChats = JSON.parse(allChats);
    for (let i in objChats){
      $("#verChats").append("<li id="+i+" style=padding: 4%; text-align: left; border-top: gray; >"+objChats[i].nomus+"</li>"); //Agregarlos con el id del índide del array
      $("#verChats").append("<div class='dropdown-divider'></div>"); //Poner rayita
    }
    $("#verChats").click(()=>{
      var ind = event.target.id;
      document.cookie = "otro="+objChats[ind].usuario+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere chatear
      location.href ="../../vista/maquetado/chat.php";
    });
  }
  else //Aún no ha chateado con nadie haha
    $("#verChats").append("<li style=padding: 4%; text-align: left; border-top: gray;  class='dropdown-divider'>Aún no tienes ninguna conversación</li>");

}

function busca_usu(usuBusc) {
  $.ajax({
      url:"../../modelo/PHP/busca.php",
      data:{
       usuario : usuBusc
      },
      type: "POST",
      success: function(response){
        if (response != "invalido"){// Eso manda PHP si se ingresó algún dato incorrecto
           if (response != ""){
             if (response == "diferente") //No es está buscando a él mismo
                document.cookie = "usuBuscado="+usuBusc+";max-age=2"; //Si no se busca a él mismo se crea la cookie, entonces se toma ésta cookie y así se hace la búsquedpara mostrar el perfil
             location.href ="perfil_usuario.php"; //Llevarlo al perfil del usuario
           }
           else
            ModalGlobal("Búsqueda","Lo siento, tu amigo no está registrado en esta plataforma");
        }
        else
           ModalGlobal("Búsqueda","Ingresa un usuario válido");
      }
  });
}

function ModalGlobal (encabezado, contenido){//sustituir alert hacer una ventana Modal
  let enc = $("<p>"+encabezado+"</p>");
  let cont = $("<p>"+contenido+"</p>");
  $("#encabezado").empty();
  $("#contenidoModal").empty();
  enc.appendTo("#encabezado");
  cont.appendTo("#contenidoModal");
  $("#ModalGlobal").modal("show"); //mostrar la ventana modal
  $("#ModalGlobal").css({"transition":"all 1s","color":"#E98836"});

}
