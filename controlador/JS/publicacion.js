
// var publi = 14; //ejemplo poco texto
var publi = 12; //ejemplo mucho texto

// publicacion(publi,false,()=>{
//     var reacciones = $(".reac>img"); //todas las img de reacciones
//     $(reacciones).on("click",(event)=>{
//         reac = event.target.className; //el id es el tipo de reacción
//         if(reac=="Mmm" || reac=="Jajajaja" ||reac=="Me vale")
//             $.ajax({
//                 url:"../../modelo/PHP/reacciona.php",
//                 data:{
//                     idPubli: publi,
//                     tipoReac: reac
//                 },
//                 type:"POST"
//             });
//         //cambia color de bordes
//         for(let v of $(reacciones))
//             $(v).css("border-color","#8FCED0");
//         //pone el color de de la reacción elegida, naranja
//         $(event.target).css("border-color","#E98836");
//     });
// });

publicacion(publi,false,()=>{
    $("#"+publi+" .btn").one("click",()=>{
        document.cookie = "pub="+publi+";max-age=300";
    });
});
