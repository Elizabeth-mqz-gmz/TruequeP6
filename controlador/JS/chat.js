var chat = document.getElementsByTagName("div")[0];
var usuario = "317346746";
var receptor =  "317346743";
var usuNomus = "Sophia";
var recNomus ="Kaime";
var datos, ultimoMen, mensajes;
var llave = usuNomus+recNomus;
function mens(mens){
    if(mens == null)
      $(chat).html($(chat).html()+"<br/>Saluda a "+recNomus+"!");
    else{
      mensajes = JSON.parse(mens);
      for (var i in mensajes){
        if (datos.quienEnvio == mensajes[i].emisor)
            $(chat).append("Tú: "+mensajes[i].mensaje+"<br/>");
        else
            $(chat).append(recNomus+":"+mensajes[i].mensaje+"<br/>");
      }
      ultimoMen = mensajes[mensajes.length-1].idMen;
    }
    $("#enviar").on("click",()=>{
        var mensaje = $("input")[0].value;
        if(mensaje!="")
            $.ajax({
                url:"../../modelo/PHP/guarda_mensaje.php",
                data:{
                    chat : datos.chat,
                    men : mensaje,
                    envia : datos.quienEnvio,
                    llave : llave
                },
                type: "POST",
                success: function(response){
                    $("input")[0].value= "";
                    $(chat).append("Tú: "+mensaje+"<br/>");
                }
            });
    });
    $("#actu").on("click",()=>{
        $.ajax({
            url:"../../modelo/PHP/dame_mens.php",
            data:{
                busq :"SELECT id_men,mensaje,emisor FROM mensaje where id_chat ='"+datos.chat+"' AND id_men >'"+ultimoMen+"';",
                llave : llave
            },
            type: "POST",
            success: function(response){
                if(response != ""){
                    console.log(response);
                    let nuevosMen = JSON.parse(response);
                    for (var i in nuevosMen)
                      if (datos.quienEnvio != nuevosMen[i].emisor){
                          console.log(mensajes);
                          $(chat).append(recNomus+":"+nuevosMen[i].mensaje+"<br/>");
                          mensajes.push(nuevosMen[i]);
                      }
                    ultimoMen = mensajes[(mensajes.length)-1].idMen;
                }
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
            if (datos.quienEnvio == 0)
                llave = recNomus+usuNomus;
            return cb(datos.chat);
        }
    });
}

datos_chat((r)=>{
    $.ajax({
        url:"../../modelo/PHP/dame_mens.php",
        data:{
            busq :"SELECT id_men,mensaje,emisor FROM mensaje where id_chat ='"+r+"';",
            llave : llave
        },
        type: "POST",
        success: function(response){
            if ( response == "")
              return mens(null);
            else
              return mens(response);
        }
    });
});
