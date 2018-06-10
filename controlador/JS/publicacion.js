
// var publi = cookie de la publicacion
var coo = [];
//separa la cookie en arreglo por ";"
coo = document.cookie.split(";");
var cookie;
//busca el valor con "pub", es una regex
//si la encuentra, su siguiente índice el es el valor de la cookie pub
//ese valor es el número de publicación actual
for(let v of coo)
    if(v.search(/pub/)!=-1)
        cookie = v;
var cookieBuscada = cookie.split("=");
var publi = cookieBuscada[1];
publicacion(publi,true,()=>{
    var reacciones = $(".reac>img"); //todas las img de reacciones
    $(reacciones).on("click",(event)=>{
        reac = event.target.className; //el id es el tipo de reacción
        if(reac=="Mmm" || reac=="Jajajaja" ||reac=="Me vale")
            $.ajax({
                url:"../../modelo/PHP/reacciona.php",
                data:{
                    idPubli: publi,
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
    comentario(publi);
});

$("#enviarComen").on("click",()=>{
//ajax que guarda comentario en la BD, publi es id_publicacion
//comentario es el mensaje, comentario
    var inp = document.getElementById("comentar");
    comentario = inp.value;
    $.ajax({
        url:"../../modelo/PHP/guarda_comen.php",
        data:{
            idPubli: publi,
            comen: comentario
        },
        type: "POST",
        success: function(){
            $(inp).val("");
            $("#contenedorComen").append("<div class='denc'>Tú :"+comentario+"<img class='denim' src='../recursos/den.png'/></div>");
        }
    });
});
