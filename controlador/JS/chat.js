var chat = document.getElementById("chat");
var coo = [];
coo = document.cookie.split(";");
var cookie;
for(let v of coo)
    if(v.search(/otro/)!=-1)
        cookie = v;
var cookieBuscada = cookie.split("=");
var receptor = cookieBuscada[1];
var usuario, usuNomus, recNomus, datos, ultimoMen, mensajes, llave;

let nomsUsus = new Promise(function(resolve, reject) {
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
            llave = usuNomus+recNomus;
            resolve("Yap");
        }
    });
});
nomsUsus.then(()=>{
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
});
