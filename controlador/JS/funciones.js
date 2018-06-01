function publicacion(idPub,individual,cb){
//individual false, muestra boton, es para ver publicaciones
//individual true, es el modo de comentarios y reacciones
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
            let divGeneral = "<div id='"+idPub+"' class='card' style='width:25rem;''>";
            let imgDiv2 = "<img class='card-img-top'/><div class='card-body'>";
            let texto = "<h5 class='card-title'></h5><p class='card-text'></p>";
            let boton;
            if(individual)
                boton = "<div class='reac'><img src='../recursos/nmp.png'/ id='Me vale'><img src='../recursos/md.png'/ id='Jajajaja'><img src='../recursos/mmm.png' id='Mmm'/></div>";
            else
                boton = "<a href='#' class='btn btn-primary'>Ver publicación</a>";
            let estado = "</div><h6></h6></div>";

            $("#contenedor").append(divGeneral+imgDiv2+texto+boton+estado);
            $("#"+idPub+">div>h5").text(publi.autor);
            $("#"+idPub+">div>p").text(publi.publicacion);
            $("#"+idPub+">img").attr("src","../../modelo/PHP/"+publi.imagen);
            $("#"+idPub+">h6").text(publi.estado);
            if(publi.estado=="inconcluso")
                $("#"+idPub+">h6").css("color","red");//cambiar a color elegido
            else if(publi.estado=="inconcluso")
                $("#"+idPub+">h6").css("color","green");//cambiar a color elegido
            //$("#"+idPub+">h6").css("text-transform","capitalize");// poner clase en css
            if(individual)
                return cb();
            else
                return;
        }
    });
}
