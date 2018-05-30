var idPub = 3 ;
$.ajax({
    url:"../../modelo/PHP/publicacion.php",
    data:{
        idPubli: idPub
    },
    type:"POST",
    success: function(response){
        console.log(response);
        var publi = JSON.parse(response);
        $("#contenedor").append("<div id='"+idPub+" class='publi'><h5></h5><img/><p></p><div></div></div>");
        $("#"+idPub+">h5").text(publi.autor);
        $("#"+idPub+">p").text(publi.publicacion);
        $("#"+idPub+">img").attr("src",publi.imagen);
        $("#"+idPub+">div").text(publi.estado);
    }
});
