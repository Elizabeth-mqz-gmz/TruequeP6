
// var publi = cookie de la publicacion
var coo = [];
//separa la cookie en arreglo por ";"
coo = document.cookie.split(";");
console.log(coo);
var cookie, comentarios;
//busca el valor con "pub", es una regex
//si la encuentra, su siguiente índice el es el valor de la cookie pub
//ese valor es el número de publicación actual
for(let v of coo)
    if(v.search(/pub/)!=-1)
        console.log(v);
        cookie = v;
var cookieBuscada = cookie.split("=");
var publi = cookieBuscada[1];
var n = publi;

publicacion(publi,true,()=>{
    var reacciones = $(".reac>img"); //todas las img de reacciones
    $(reacciones).on("click",(event)=>{
        reac = event.target.className; //el id es el tipo de reacción
        if(reac=="Mmm" || reac=="Jajajaja" ||reac=="Me vale")
            $.ajax({
                url:"../../modelo/PHP/reacciona.php",
                data:{
                    idPubli: n,
                    tipoReac: reac
                },
                type:"POST"
            });
        //cambia color de bordes
        for(let v of $(reacciones))
            $(v).css("border-color","#8FCED0");
        //pone el color de de la reacción elegida, naranja
        $(event.target).css("border-color","#E98836");
    });
    comentario(n);
});
$("#enviarComen").on("click",()=>{
//ajax que guarda comentario en la BD, publi es id_publicacion
//comentario es el mensaje, comentario
    comentario = $("#comentar").val();
    if (comentario != ""){
      $.ajax({
          url:"../../modelo/PHP/guarda_comen.php",
          data:{
              idPubli: n,
              comen: comentario
          },
          type: "POST",
          success: function(response){
              $("#noComen").hide()
              $("#comentar").val("");
              $("#contenedorComen").append("<div><div class='comen'>Tú: "+comentario+"</div></div>");
          }
      });
    }
});
$("#contenedorComen").click((ev)=>{ //Este evento denuncia un comentario
  let val = ev.target.className;
  if (val == "denunc") { //Checar que le haya clickeado al monito
    let ind = ev.target.id;
    $.ajax({
        url:"../../modelo/PHP/denun_comen.php",
        data:{
            comenID: comentarios[ind].idComen //Id del comentario
        },
        type: "POST",
        success: function(response){
            // console.log($("#"+ind));
            $("#"+ind+".denunc").hide(); //No sé porque se borra todo el comentario jajajaj, pero no tendría que ser así
            ModalGlobal("Éxito","Se denunció el comentario"); //Me manda un error, no sé por qué ):
        }
    });
  }
});
