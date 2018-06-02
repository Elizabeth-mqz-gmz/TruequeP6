
// var publi = cookie de la publicacion
var coo = [];
coo = document.cookie.split(";");
var cookie;
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

$(".container .btn").on("click",()=>{

});
