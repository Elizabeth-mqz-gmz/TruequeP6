var chat = document.getElementById("chat"); //Cuadrito de chat en la página
var coo = [];
coo = document.cookie.split(";");//Para encontrar el num de cuenta de la perona con la que quiere hablar
var cookie;
for(let v of coo)
    if(v.search(/otro/)!=-1)
        cookie = v;
var cookieBuscada = cookie.split("=");
var receptor = cookieBuscada[1];
var usuario, usuNomus, recNomus, datos, ultimoMen, mensajes, llave, fechaEven;

let nomsUsus = new Promise(function(resolve, reject) { //Obtener los nombres de usuario
    $.ajax({
        url:"../../modelo/PHP/dame_usus.php",
        data:{
          otro : receptor
        },
        type: "POST",
        success: function(response){
            let personas = JSON.parse(response);
            usuario = personas.usuario;
            usuNomus = personas.usuNomus;
            recNomus = personas.usuRec;
            llave = usuario+receptor; //Hacer la llave para el cifrado
            resolve("Yap");
            $("#amiko").append(recNomus);
        }
    });
});
nomsUsus.then(()=>{
      datos_chat((r)=>{ //callback, primero se ejecuta lo de datos_chat
        $.ajax({
            url:"../../modelo/PHP/dame_mens.php",
            data:{ //Pongo la búsqueda lit, porque ué el mismo archivo php para ver los nuevos mensajes
                busq :"SELECT id_men,mensaje,emisor,hora_men FROM mensaje where id_chat ='"+r+"';",
                llave : llave
            },
            type: "POST",
            success: function(response){
              console.log(response);
                if ( response == "")
                  return mens(null);
                else
                  return mens(response);
            }
        });
      });

});
//BOTONES DE CHAT

//Evento
$("#Genial").hide(); //Ocultar el input hasta que todos los datos de la fecha estén bien
$("#NuevoEvento").on("change",()=>{
  if ( document.getElementById("fechaFE").value != "" && document.getElementById("horaFE").value != "" && $("#lugar").val()!= ""){
    fechaEven = valdt();
    if (fechaEven != "loser")
      $("#Genial").show();
    else
      $("#Genial").hide(); //Ocultar el input hasta que todos los datos de la fecha estén bien, por si los cambia
  }
});

$("#Genial").click(function(){
  eventoP = $("input:checked").val();
  dondeEs = $("#lugar").val();
  $.ajax({ //Meter en la base de datos el evento
    url:"../../modelo/PHP/nuevo_evento.php",
    data:{
      fecha : fechaEven,
      chat : datos.chat,
      evento : eventoP,
      lugar : dondeEs
    },
    type: "POST",
    success: function(response){
      ModalGlobal("Éxito","Se registró el evento :)"); //Cerrar la ventana modal, no sé cómo jajajaj
      document.getElementById("formularioEvento").reset();
      $("#NuevoEvento").modal("hide");//cerrar la ventana modal
      }
    });
});
//Enviar y actualizar
$("#enviar").on("click",()=>{
    var mensaje = $("#mensaje").val();
    if(mensaje!="")
      var hora = new Date();
      let hr;
      if( hora.getMinutes() > 9 ) //esto sólo es para que se vea bonito jajajaj
        hr = hora.getHours()+":"+hora.getMinutes();
      else
        hr = hora.getHours()+":0"+hora.getMinutes();

      // console.log(hr);
        $.ajax({
            url:"../../modelo/PHP/guarda_mensaje.php",
            data:{
                chat : datos.chat, //EL id del Chat
                men : mensaje,
                envia : datos.quienEnvio, //Puede ser 0 o 1, dependiendo de si el usuario es el emisor en la tabla chat
                llave : llave,
                horaMen : hr
            },
            type: "POST",
            success: function(response){ //Ya que se guardó el mensaje
                // console.log(response);
                $("#mensaje").val(""); //Limpiar el imput
                $(chat).append("<div class='row'><div class='col aux'></div><div class='col yo'>  "+mensaje+"<small>"+hr+"</small></div></div>"); //Agregarlo al html
                $("#saludo").remove();
            }
        });
});
$("#actu").on("click",()=>{
    $.ajax({
        url:"../../modelo/PHP/dame_mens.php",
        data:{
            busq :"SELECT id_men,mensaje,emisor,hora_men FROM mensaje where id_chat ='"+datos.chat+"' AND id_men >'"+ultimoMen+"';", //Checar que no esté guardado en el html ya, o sea que no se haya sacado de la bd
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
                        $(chat).append("<div class='row'><div class='otro'>  "+nuevosMen[i].mensaje+"<small>"+nuevosMen[i].hora.substr(0,5)+"</small></div></div>");
                        mensajes.push(nuevosMen[i]); //Agregarlo al array de mensajes
                    }
                // console.log(ultimoMen);
                ultimoMen = mensajes[(mensajes.length)-1].idMen; //GUardar el último mensaje para que no se repitan
            }
            else
              ModalGlobal("Nadie te quiere","Lo siento, no hay nuevos mensajes):")
        }
    });
  });
