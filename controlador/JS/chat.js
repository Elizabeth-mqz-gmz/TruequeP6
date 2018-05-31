
var chat = document.getElementsByTagName("div")[0];
var usuario = "317346752";
var receptor =  "317346751";
var enviar = document.getElementsByTagName("button")[0];
var usuNomus = "Paola";
var recNomus ="Emy";
var datos;

function mens(mensajes){
    if(mensajes == null){
      $(chat).html($(chat).html()+"<br/>Saluda a "+recNomus+"!");
      console.log("No hay mensajes");
    }
    else{
      mensajes = JSON.parse(mensajes);
      for (var i in mensajes){
        if (datos.quienEnvio == mensajes[i].emisor)
            $(chat).html($(chat).html()+"<br/>"+usuNomus+":"+mensajes[i].mensaje);
        else
            $(chat).html($(chat).html()+"<br/>"+recNomus+":"+mensajes[i].mensaje);
      }
      console.log("Ya hablaron");
    }
    $(enviar).on("click",()=>{
        var mensaje = $("input")[0].value;
        if(mensaje!="")
            $.ajax({
                url:"../../modelo/PHP/guarda_mensaje.php",
                data:{
                    chat : datos.chat,
                    men : mensaje,
                    envia : datos.quienEnvio
                },
                type: "POST",
                success: function(response){
                    $(chat).html($(chat).html()+"<br/>"+usuNomus+":"+mensaje);
                    console.log(response);
                }
            });
    });
    return;
}

function datos_chat(cb){
    $.ajax({
        url:"../../modelo/PHP/dame_chat.php",
        data:{
            usuEm : usuario,
            usuRec : receptor
        },
        type: "POST",
        success: function(response){
            datos = JSON.parse(response);
            console.log(response);
            return cb(datos.chat);
        }
    });
}

datos_chat((r)=>{
    console.log(r);
    $.ajax({
        url:"../../modelo/PHP/dame_mens.php",
        data:{
            chat : r
        },
        type: "POST",
        success: function(response){
            // console.log(response);
            if ( response == "1er_men]"){
              return mens(null);
            }
            else
              return mens(response);

        }
    });
});
