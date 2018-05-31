var idPub = 3 ;
$.ajax({
    url:"../../modelo/PHP/publicacion.php",
    //pide una publicación con el id_publicacion = idPub
    data:{
        idPubli: idPub
    },
    type:"POST",
    //genera los elementos html con clases bootstrap, de la publicacion
    success: function(response){
        //el php regresa un json
        var publi = JSON.parse(response);
        //clases de bootstrap
        $("#contenedor").append("<div id='"+idPub+"' class='card' style='width:18rem;''><img class='card-img-top'/><div class='card-body'><h5 class='card-title'></h5><p class='card-text'></p></div><h6></h6></div>");
        $("#"+idPub+">div>h5").text(publi.autor);
        $("#"+idPub+">div>p").text(publi.publicacion);
        $("#"+idPub+">img").attr("src",publi.imagen);
        $("#"+idPub+">h6").text(publi.estado);
    }
});
