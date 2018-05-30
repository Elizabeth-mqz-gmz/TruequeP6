
var chat = document.getElementsByTagName("div")[0];
var usuario = "317000002";
var receptor =  "317000001";
var boton = document.getElementsByTagName("button")[0];

$(document).ready(()=>{
    $(boton).on("click",()=>{
        var mensaje = $("input")[0].value;
        if(mensaje!="")
            $.ajax({
                url:"../../modelo/PHP/guarda_mensaje.php",
                data:{
                    "usuEm":usuario,
                    "men":mensaje,
                    "usuRec": receptor
                },
                type: "POST",
                success: function(){
                    $(chat).html($(chat).html()+"<br/>"+mensaje);
                }
            });
    });
    /*setInterval(()=>{
        $.ajax({
            url:"../../modelo/PHP/muestra_mensajes.php",
            data:{
                "usuEm":usuario,
                "men":mensaje,
                "usuRec": receptor
            }
            type: "POST",
            success: function(response){
                $(chat).text(response);
            }
        });
    },5000);*/

});
