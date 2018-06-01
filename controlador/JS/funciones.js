
function comentario(idPub){
    console.log(idPub);
    $("")
    return;
}

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
            //console.log(response);

            //el php regresa un json
            var publi = JSON.parse(response);
            //clases de bootstrap
            let divGeneral = "<div id='"+idPub+"' class='card'>";
            let imgDiv2 = "<img class='card-img-top'/><div class='card-body'>";
            let texto = "<h5 class='card-title'></h5><div class='den'><img src='../recursos/den.png'/></div><p class='card-text'></p>";
            let boton;
            if(individual)
                boton = "<div class='reac'><img src='../recursos/nmp.png'/ class='Me vale'><img src='../recursos/md.png'/ class='Jajajaja'><img src='../recursos/mmm.png' class='Mmm'/></div>";
            else
                boton = "<a href='#' class='btn btn-primary'>Ver publicación</a>";
            let estado = "</div><h6></h6></div>";

            //contenedor puede ser cualquier caja IMPORTANTE
            $("#contenedor").append(divGeneral+imgDiv2+texto+boton+estado);
            $("#"+idPub+">div>h5").text(publi.autor);
            $("#"+idPub+">div>p").text(publi.publicacion);

            //OJO no agregar o quitar clases de img, IMPORTANTE para reacciones
            $("#"+idPub+">img").attr("src","../../modelo/PHP/"+publi.imagen);
            $("#"+idPub+">h6").text(publi.estado);

            if(publi.estado=="inconcluso")
                $("#"+idPub+">h6").css("color","red");//cambiar a color elegido
            else if(publi.estado=="terminado")
                $("#"+idPub+">h6").css("color","green");//cambiar a color elegido

            //si el usuario actual ya reaccionó se pone naranja la reacción
            if(publi.usuReac!="null")
                if(publi.usuReac=="Me vale")//Me vale, causa error por tener espacio, corregido
                    $("#"+idPub+" .reac>img:first-child").css("border-color","#E98836");
                else
                    $("."+publi.usuReac).css("border-color","#E98836");

            if(publi.esAutor=="true"){
                //poner borde si es autor
                $("#"+idPub+">h6").css("border","1px solid #1919BEBE");

                //al darle click al estado, este se cambia y actualiza en la base de datos
                $("#"+idPub+">h6").on("click",()=>{
                    let est;
                    //cambia color, texto y valor del POST
                    if($("#"+idPub+">h6").css("color")=="rgb(255, 0, 0)"){
                        est = "terminado";
                        $("#"+idPub+">h6").text(est);
                        $("#"+idPub+">h6").css("color","green");
                    }
                    else{
                        est = "inconcluso";
                        $("#"+idPub+">h6").text(est);
                        $("#"+idPub+">h6").css("color","red");
                    }
                    //actualiza en la BD
                    $.ajax({
                        url:"../../modelo/PHP/concluye_pub.php",
                        data:{
                            idPubli: idPub,
                            estado: est
                        },
                        type: "POST"
                    });

                });
            }
            //si la denuncia es 0, muestra la imagen, del contrario no
            //al darle click en la imagen de denuncia, cambia el estado 
            if(publi.denuncia == "0")
                $("#"+idPub+" .den").on("click",()=>{
                    $("#"+idPub+" .den").hide();
                    $.ajax({
                        url:"../../modelo/PHP/denuncia.php",
                        data:{
                            idPubli: idPub,
                        },
                        type: "POST"
                    });
                });
            else
                $("#"+idPub+" .den").hide();
            //para cuando está con comenatrios y reacciones, se ejecute un callback
            //para el botón se agrega el evento click
            return cb();
        }
    });
}
