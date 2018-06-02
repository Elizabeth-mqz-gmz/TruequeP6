//funciones Administrador
mostrar = [];
mostrar["1"] = desplegarPublicacion;
mostrar["2"] = desplegarComentario;

$("#publicaciones").on("click", function(){
  $(".quitar").remove();
  denuncia("1", "Publicaciones");
});

$("#comentarios").on("click", function(){
  $(".quitar").remove();
  denuncia("2","Comentarios");
});

function desplegarPublicacion(respuesta){
  let publi = respuesta;
  let  datos = $("<img src='"+respuesta.imagen_publi+"'/ class='quitar'><p class='quitar'>"+respuesta.publicacion+"</p>");
  datos.appendTo("#contPublicaciones");
  console.log(publi);
  console.log(publi.publicacion);
}

function desplegarComentario(respuesta){
  let comentario = $("<p class='quitar'>"+respuesta.comentario+"</p>");
  datos.appendTo("#contComentarios");
}

function mostrarContenido(id_cont, valor){
  console.log(id_cont);
  jQuery.ajax({
      url:"../../modelo/PHP/motivo_denun.php",
      type: "POST",
      data:{
        id : id_cont,
        tabla : valor
      },
      success: function(response){
        mostrar[valor](JSON.parse(response);
        //console.log(response);// obtiene comentario o imagen
      }
  });
}

function mostrar_publid(respuesta, donde){
  for (let i in respuesta ){
    let autor = $("<div class='quitar'><div>"+respuesta[i].id_autor+"</div><button autor ='"+respuesta[i].id_autor+"'publi='"+respuesta[i].id_publicacion+"' value = 'quitarD'>Quitar Denuncia</button><button autor ='"+respuesta[i].id_autor+"'publi='"+respuesta[i].id_publicacion+"' value = 'eliminarD'>Eliminar Publicación</button></div>");
    autor.appendTo("#cont"+donde);
  }
}

function denuncia(valor, donde){
  jQuery.ajax({
      url:"../../modelo/PHP/obtener_denuncia.php",
      type: "POST",
      data:{
        tabla : valor
      },
      success: function(response){
            mostrar_publid(JSON.parse(response), donde, valor);
            console.log(valor);
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
