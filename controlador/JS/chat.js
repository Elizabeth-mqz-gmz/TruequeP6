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
            llave = usuNomus+recNomus; //Hacer la llave para el cifrado
            resolve("Yap");
        }
    });
});
nomsUsus.then(()=>{
      datos_chat((r)=>{ //callback, primero se ejecuta lo de datos_chat
        $.ajax({
            url:"../../modelo/PHP/dame_mens.php",
            data:{ //Pongo la búsqueda lit, porque ué el mismo archivo php para ver los nuevos mensajes
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
$("#Genial").hide(); //Ocultar el input hasta que todos los datos de la fecha estén bien
$("#NuevoEvento").on("change",()=>{
  if ( ($("#hora").val()!= "") && ($("#anho").val()!="") && ($("#mes").val()!="") && ($("#min").val()!="") && ($("#dia").val()!="")){
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
      alert("Se registró el evento :)"); //Cerrar la ventana modal, no sé cómo jajajaj
      }
    });
});
