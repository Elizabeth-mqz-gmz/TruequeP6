function comentario(idPub){  //Obtener todos los comentarios de la publicación que recibe como argumento
  // var comentarios;
    $.ajax({
        url:"../../modelo/PHP/dame_comen.php",
        data:{
            idPubli:idPub
        },
        type: "POST",
        success: function(response){
          // console.log(response);
          if (response != "null"){ //Que sí haya comentarios
            $("#noComen").hide()
            // console.log(response);
            comentarios = JSON.parse(response);

            // console.log(comentarios);
            for (let i in comentarios){ //Los va agregando
                  if (comentarios[i].nomus != nombreUsuarioOf)
                      $("#contenedorComen").append("<div><div class='comen'>"+comentarios[i].nomus+" dice: "+comentarios[i].comentario+"</div><img id='"+i+"' class='denunc' src='../recursos/den.png'/></div>");
                  else
                      $("#contenedorComen").append("<div><div class='comen'>"+comentarios[i].nomus+" dice: "+comentarios[i].comentario+"</div></div>");
            }
            // console.log($(".comen~img"));
          }
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
            let divGeneral = "<div id='"+idPub+"' class='card' style='width: 45%;'>";
            let imgDiv2 = "<img class='card-img-top'/><div class='card-body'>";
            let texto = "<h5 class='card-title'></h5><div class='den' data-toggle='modal' data-target='#denuncia'><img src='../recursos/den.png'/></div><p class='card-text'></p>";
            //con MODAL
            let boton;
            if(individual)
                boton = "<div class='reac'><img src='../recursos/nmp.png'/ class='Me vale'><img src='../recursos/md.png'/ class='Jajajaja'><img src='../recursos/mmm.png' class='Mmm'/></div>";
            else
                boton = "<a href='publicacion.php' class='btn bot-publi' style='text-decoration:none'>Ver publicación</a>";
            let estado = "</div><h6></h6><span>Me interesa<i class='fa fa-flag'></i></span></div>";

            let botonParaChat = "<a href='chat.php' id='chat"+idPub+"' class='btn bot-publi' style='text-decoration:none'>Enviar mensaje</a>";
            //contenedor puede ser cualquier caja IMPORTANTE
            $("#contenedorPubli").append(divGeneral+imgDiv2+texto+boton+botonParaChat+estado);
            $("#"+idPub+">div>h5").append("<div class='autor' id='aut"+publi.idAutor+"pub"+idPub+"'>"+publi.autor+"</div>");
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

                $("#chat"+idPub).hide(); //Ocultar el botón para chat
            }
           if(publi.denuncia == "0") //con MODAL
               $("#"+idPub+" .den").on("click",()=>{
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
                           $("#"+idPub+" .den").hide();
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
                        $("#"+idPub+">span").css("color","teal");
                    }
                });
            });

            //COSAS DE Chat
            $("#chat"+idPub).click(()=>{
              document.cookie = "otro="+publi.idAutor+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere chatear
              location.href ="../../vista/maquetado/chat.php";
            });

            //Cuando le da clic en el username lo redirige a su perfil
            $("#aut"+publi.idAutor+"pub"+idPub).click(()=>{
              document.cookie = "usuBuscado="+publi.idAutor+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere chatear
              location.href ="../../vista/maquetado/perfil_usuario.php";
            });

            //Que se muestre la foto en grande
            $("#"+idPub+">img").click(()=>{
              // console.log("Muestro la imagen");
              fotoPubli(publi.publicacion,"../../modelo/PHP/"+publi.imagen);
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
  $("<div id='calendario' style='width:100%; height: 400px; overflow-y: scroll;'>").appendTo("#evento");
  for ( i in respuesta){
    respuesta[i].fecha = new Date(respuesta[i].fecha);
    mes = parseInt(respuesta[i].fecha.getMonth());
    mes ++;;
    dia = respuesta[i].fecha.getDate() +"/"+ mes.toString() + "/"+ respuesta[i].fecha.getFullYear();
    hora = respuesta[i].fecha.getHours();
    min = respuesta[i].fecha.getMinutes();
    if (hora < 10)//hacer que la hora se vea 09:09 y no 9:9
      hora = "0" + hora.toString();
    if (min < 10)
      min = "0" + min.toString();
    let fecha = "<div >El día <span style='color:#E98836;'><b>"+dia+"</b></span> en el horario <span style='color:#E98836;'><b>"+ hora + ":" +min +"</b></span>";//mientras no está súper definido como se mostrará el calendario, así no está todo muy amontonado
    let personas = " se encontrarán "+respuesta[i].id_em+" y "+respuesta[i].id_rec;
    let evento = "<h4>"+respuesta[i].tipo_even+"</h4>";
    let lugar = " en "+respuesta[i].lugar+"</div>";
    $("<div class='dropdown-item disabled' style='color:#3D343F;'>"+ evento + fecha +"<br />"+ personas +  lugar +"</div>").appendTo("#calendario");
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
      $(chat).html($(chat).html()+"<br/><div id='saludo'>Saluda a "+recNomus+"!<div><br />");
    else{
      console.log(mensajes);
      mensajes = JSON.parse(mens);
      for (var i in mensajes){
        if (datos.quienEnvio == mensajes[i].emisor) //SIgnifica que la persona mandó en mensaje
            $(chat).append("<div class='row'><div class='col aux'></div><div class='yo col'>  "+mensajes[i].mensaje+"<small>"+mensajes[i].hora.substr(0,5)+"</small></div></div>");
        else
            $(chat).append("<div class='row'><div class='otro'>  "+mensajes[i].mensaje+"<small>"+mensajes[i].hora.substr(0,5)+"</small></div></div>");
      }
      ultimoMen = mensajes[mensajes.length-1].idMen; //Obtener el último id para hacer la búsqueda en la bd cuando quiera ver los nuevos mensajes
    }
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
                llave = receptor+usuario;
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
  // console.log(allChats);
  if(allChats!= ""){ //Validar qu etenga chats
    objChats = JSON.parse(allChats);

    for (let i in objChats)
      $("#verChats").append("<li id="+i+" class='despliega'>"+objChats[i].nomus+"<div class='dropdown-divider'></div></li>"); //Agregarlos con el id del índide del array

    $("#verChats").click(()=>{
      var ind = event.target.id;
      document.cookie = "otro="+objChats[ind].usuario+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere chatear
      location.href ="../../vista/maquetado/chat.php";
    });

  }
  else //Aún no ha chateado con nadie haha
    $("#verChats").append("<li style=padding: 4%; text-align: left; border-top: gray; >Aún no has chateado con nadie<div class='dropdown-divider'></div></li>"); //Agregarlos con el id del índide del array

}


function chat_nuevo() {
  // console.log(usuarios);

  $("#usuarioParaChatear").keydown(()=>{
    let hay = false;
    let buscado = $("#usuarioParaChatear").val();

    if (buscado != ""){

        $("#mostrarPers").children("li").remove(); //Para que sólo los muestre una vez
        let reg = new RegExp ("^("+buscado+")","i");
        // console.log(reg);
        for (let i in todosLosUsuariosOf) //No sería eficiente en 1000 usuarios, pero ahora sirve
          if( (reg.test(todosLosUsuariosOf[i].nomus) || reg.test(todosLosUsuariosOf[i].usuario)) && todosLosUsuariosOf[i].usuario != "usuarioOf"){
            $("#mostrarPers").append("<li class='despliega' id='"+i+"' style=padding: 4%; text-align: left; border-top: gray;>"+todosLosUsuariosOf[i].nomus+"</li>");
            hay = true;
          }

        if (!hay) //No se encontró nada en la búsqueda
          $("#mostrarPers").append("<li class='despliega' style=padding: 4%; text-align: left; border-top: gray;>No se encontró usuario</li>");

    }
  });
  $("#mostrarPers").click(()=>{
    var ind = event.target.id;
    document.cookie = "otro="+todosLosUsuariosOf[ind].usuario+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere chatear
    location.href ="../../vista/maquetado/chat.php";
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
    $("#ModalGlobal").css("transition","all 1s");
}

function colores(elemento){
  elemento.width = window.innerWidth/4;
	elemento.height = window.innerHeight;
  var lienzo = elemento.getContext("2d");
  lienzo.lineWidth=1;
  lienzo.lineCap="round";
  var inicio;
  var colores =["#FBF8F7","#8FCED0","#E98836","#1919BEBE","#3D343F"]
  var aux = 0;
  var x=0;
  var z=0;
  function animacion(timer,color){
    if(aux<5)
      aux++;
    else
      aux = 0;

    if(!inicio)
      inicio=timer;
    var progreso = timer-inicio;
    x+=20;
    if (progreso<10000){
      lienzo.strokeStyle=colores[aux];
      if(x>155)
        x=0;
      x++;
      z+=20;
      if(z>1500)
        z=6;
      linea(0,0,x);
      lienzo.rotate(2*(Math.PI/180));
      lienzo.scale(3,1);
      requestAnimationFrame(animacion,color++);
    }
  }
  function linea(x,y,rax){
    var a=setInterval(()=>{
      lienzo.beginPath();
      lienzo.moveTo(-250,0);
      lienzo.lineTo(100,0);
      lienzo.moveTo(x,y);
      lienzo.arc(x,y-rax,rax,0,2*Math.PI,true);
      lienzo.stroke();
      lienzo.closePath();
    });
  }
  function anima(){
    requestAnimationFrame(animacion,0);
  }
  lienzo.translate(370,300);
    anima();
}

function fotoPubli (publicacion, imagen){//sustituir alert hacer una ventana Modal
    let imag = $("<img src='"+imagen+"'/><div class='carousel-caption d-none d-md-block' style='background-color:rgba(0,0,0,0.3);'><h5>"+publicacion+"</h5></div>");
    $("#imagenPubli").empty();
    imag.appendTo("#imagenPubli");
    $("#ModalFoto").modal("show"); //mostrar la ventana modal
    $("#ModalFoto").css("transition","all 1s");
}
