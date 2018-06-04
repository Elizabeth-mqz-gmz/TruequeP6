//funciones Administrador
//Este es el bueno :)

mostrar = [];
mostrar["1"] = desplegarPublicacion;
mostrar["2"] = desplegarComentario;

$("#publicaciones").on("click", function(){
  $(".quitar").remove();
  denuncia("1");
});

$("#comentarios").on("click", function(){
  $(".quitar").remove();
  denuncia("2");
});

function desplegarPublicacion(respuesta){
  let publi = respuesta;
  let  datos = $("<div class ='quitar'><div>"+respuesta.id_autor+"</div><p><img src='"+respuesta.imagen_publi+"' class='quitar'/><p class='quitar'>"+respuesta.publicacion+"</p><h6>"+respuesta.razon_denuncia+"</h6><button class='btn btn-warning' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn btn-danger' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'eliminarD'>Eliminar Publicación</button></div>");
  datos.appendTo("#contPublicaciones");
  // console.log("hola");
}

function desplegarComentario(respuesta){
  let datos = $("<div class ='quitar'><div>"+respuesta.id_usu_comen+"</div><p>"+respuesta.comentario+"</p><button class='btn btn-warning' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn btn-danger' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'eliminarD'>Eliminar Comentario</button></div>");
  datos.appendTo("#contComentarios");
}

function denuncia (valor){
  jQuery.ajax({
      url:"../../modelo/PHP/obtener_denuncia.php",
      data:{
          tabla : valor
      },
      type: "POST",
      success: function(response){
          // console.log(response);
          denuncias = JSON.parse(response);
          for (i in denuncias){
            mostrar[valor](denuncias[i]);
          }
      }
  });
}

function quitar_eliminar( ruta, autor_publi, id_publi, mensaje, valor, div){
  // console.log(valor);
  jQuery.ajax({
      url:"../../modelo/PHP/"+ruta+".php",
      data:{
          tabla : valor,
          usuario : autor_publi,
          publicacion : id_publi
      },
      type: "POST",
      success: function(response){
          alert("¡Proceso exitoso!, la "+mensaje+" ha sido eliminada");
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
  // console.log(publi);
  // console.log(autor);
  if (denun == "quitarD"){
    quitar_eliminar("quitar_denuncia",autor,publi,"denuncia","2","Comentarios");
  }
  else if (denun == "eliminarD"){
    quitar_eliminar("eliminar_publicacion", autor, publi, "comentario","2", "Comentarios");
  }
});
