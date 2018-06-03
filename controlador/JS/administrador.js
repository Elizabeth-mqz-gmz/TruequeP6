//funciones Administrador
mostrar = [];
mostrar["1"] = desplegarPublicacion;
mostrar["2"] = desplegarComentario;

$("#publicaciones").on("click", function(){
  $(".quitar").remove();
  console.log("holaaaaa mundooooooo, por favor funciona :)");
  denuncia("1", "Publicaciones");
});

$("#comentarios").on("click", function(){
  $(".quitar").remove();
  console.log("holaaaaa mundooooooo");
  denuncia("2","Comentarios");
});

function desplegarPublicacion(respuesta){
  let publi = respuesta;
  let  datos = $("<div class ='quitar'><div>"+respuesta.id_autor+"</div><p><img src='"+respuesta.imagen_publi+"' class='quitar'/><p class='quitar'>"+respuesta.publicacion+"</p><button class='btn btn-warning' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn btn-warning' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'eliminarD'>Eliminar Publicación</button><button data-target='byebye' class='btn btn-danger'>Eliminar Usuario</button></div>");
  datos.appendTo("#contPublicaciones");//append a event.target XD
}

function desplegarComentario(respuesta){
  let datos = $("<div class ='quitar'><div>"+respuesta.id_usu_comen+"</div><p>"+respuesta.comentario+"</p><button class='btn btn-warning' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn btn-warning' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'eliminarD'>Eliminar Publicación</button><button data-target='byebye' class='btn btn-danger'>Eliminar Usuario</button></div>");
  datos.appendTo("#contComentarios");
}

function mostrarContenido(id_cont, valor){
  console.log(id_cont);
  console.log(valor);
  $.ajax({
      url:"../../modelo/PHP/motivo_denun.php",
      type: "POST",
      data:{
        id : id_cont,
        tabla : valor,
      },
      success: function(response){
        console.log("Hola Mundo");
        //n = response;
        console.log(response);
        //mostrar[valor](JSON.parse(response));
        //console.log("Hola");// obtiene comentario o imagen
      }
  });
}

function mostrar_publid(respuesta, valor){
  for (let i in respuesta ){
    mostrarContenido(respuesta[i].id_publicacion,valor);
    console.log(respuesta[i].id_publicacion);
    console.log("Hola Mundo");//aquí todo bien :)
    console.log(valor);
  }
}

function denuncia(valor){
  jQuery.ajax({
      url:"../../modelo/PHP/obtener_denuncia.php",
      type: "POST",
      data:{
        tabla : valor
      },
      success: function(response){
            mostrar_publid(JSON.parse(response),valor);
            console.log(JSON.parse(response));
      }
  });
}

function quitar_eliminar( ruta, autor_publi, id_publi, mensaje, valor, div){
  console.log(valor);
  jQuery.ajax({
      url:"../../modelo/PHP/"+ruta+".php",
      data:{
          tabla : valor,
          usuario : autor_publi,
          publicacion : id_publi
      },
      type: "POST",
      success: function(response){
          alert("¡Proceso Éxitoso!, la "+mensaje+" ha sido eliminada");
          $(".quitar").remove();
          denuncia(valor, div);
      }
  });
}

document.getElementById("contPublicaciones").addEventListener("click",()=>{
  let denun = event.target.value;
  let publi = event.target.getAttribute("publi");
  let autor = event.target.getAttribute("autor");
  if (denun == "quitarD"){
    quitar_eliminar("quitar_denuncia",autor,publi,"denuncia","1","Publicaciones");
  }
  else if (denun == "eliminarD"){
    quitar_eliminar("eliminar_publicacion", autor, publi, "publicación","1","Publicaciones");
  }
});
//hacer funcion pequeña
document.getElementById("contComentarios").addEventListener("click",()=>{
  let denun = event.target.value;
  let publi = event.target.getAttribute("publi");
  let autor = event.target.getAttribute("autor");
  console.log(publi);
  console.log(autor);
  if (denun == "quitarD"){
    quitar_eliminar("quitar_denuncia",autor,publi,"denuncia","2","Comentarios");
  }
  else if (denun == "eliminarD"){
    quitar_eliminar("eliminar_publicacion", autor, publi, "comentario","2", "Comentarios");
  }
});
