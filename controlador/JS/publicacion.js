
var publi = 12;

publicacion(publi,true,()=>{
    var reacciones = $(".reac>img");
    $(reacciones).on("click",(event)=>{
        reac = event.target.id;
        if(reac=="Mmm" || reac=="Jajajaja" ||reac=="Me vale")
            $.ajax({
                url:"../../modelo/PHP/reacciona.php",
                data:{
                    idPubli: publi,
                    tipoReac: reac
                },
                type:"POST"
            });
        for(let v of $(reacciones))
            $(v).css("border-color","#8FCED0");
        $(event.target).css("border-color","#E98836");
    });
});
