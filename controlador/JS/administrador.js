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
  //objeto que contiene todo relacionado con la publicacion
  let imagen = respuesta.imagen_publi.replace("..","")
  respuesta.imagen_publi = imagen;
  // console.log(respuesta.imagen_publi);
  let  datos = $("<div class ='quitar'><div class='card quitar' style='width: 55%;'><div class='card-header'>"+respuesta.id_autor+"</div><div class='card-body'><img class='card-img-top' src='../../modelo/"+respuesta.imagen_publi+"' class='quitar'/><p class='quitar card-text'>"+respuesta.publicacion+"</p><h6 class='card-title'>"+respuesta.razon_denuncia+"</h6><div class='text-right'><button class='btn btn-outline-primary' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn btn-outline-danger' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'eliminarD'>Eliminar Publicación</button><button data-target='#kk'data-toggle='modal' class='btn btn-danger' value = 'usuario' class='btn btn-danger' autor ='"+respuesta.id_autor+"'>Eliminar Usuario</button></div></div></div></div>");
  datos.appendTo("#contPublicaciones");
}

function desplegarComentario(respuesta){
  let datos = $("<div class ='quitar'><div class='card quitar' style='width: 55%;'><div class='card-header'>"+respuesta.id_usu_comen+"</div><div class='card-body'><p class='card-text'>"+respuesta.comentario+"</p><div class='text-right'><button class='btn btn-outline-primary' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn btn-outline-danger' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'eliminarD'>Eliminar Comentario</button><button data-target='#kk'data-toggle='modal' class='btn btn-danger' value = 'usuario' class='btn btn-danger' autor ='"+respuesta.id_autor+"'>Eliminar Usuario</button></div></div></div></div>");
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
          denuncias = JSON.parse(response);
          for (i in denuncias){
            mostrar[valor](denuncias[i]);
          }
      }
  });
}

function quitar_eliminar( ruta, autor_publi, id_publi, mensaje, valor, div){
  // console.log(valor);
  // console.log(autor_publi);
  // console.log(id_publi);
  jQuery.ajax({
      url:"../../modelo/PHP/"+ruta+".php",
      data:{
          tabla : valor,
          usuario : autor_publi,
          publicacion : id_publi
      },
      type: "POST",
      success: function(response){
        // console.log(response);
          alert("¡Proceso Éxitoso!, la "+mensaje+" ha sido eliminada");
          $(".quitar").remove();
          denuncia(valor, div);
      }
  });
}
var autor = "Wuuu";
document.getElementById("contPublicaciones").addEventListener("click",()=>{
  let denun = event.target.value;
  let publi = event.target.getAttribute("publi");
  autor = event.target.getAttribute("autor");
  if (denun == "quitarD"){
    quitar_eliminar("quitar_denuncia",autor,publi,"denuncia","1","Publicaciones");
  }
  else if (denun == "eliminarD"){
    quitar_eliminar("eliminar_publicacion", autor, publi, "publicación","1","Publicaciones");
  }
  else if(denun == "usuario"){
    var EliminarUsuario = event.target.getAttribute("autor");
    // console.log(EliminarUsuario);
  }
});
//hacer funcion pequeña
document.getElementById("contComentarios").addEventListener("click",()=>{
  let denun = event.target.value;
  let publi = event.target.getAttribute("publi");
  autor = event.target.getAttribute("autor");
  // console.log(publi);
  // console.log(autor);
  if (denun == "quitarD"){
    quitar_eliminar("quitar_denuncia",autor,publi,"denuncia","2","Comentarios");
  }
  else if (denun == "eliminarD"){
    quitar_eliminar("eliminar_publicacion", autor, publi, "comentario","2", "Comentarios");
  }
  else if(denun == "usuario"){
    //alert("Me quieres eliminar");
     var EliminarUsuario = event.target.getAttribute("autor");
     // console.log(EliminarUsuario);
  }
});

$("#enviar").click(()=>{
    $("#alert").remove();
    var usuario = $("#usuario").val();
    var contra = $("#contrasena").val();
    jQuery.ajax({
        url:"../../modelo/PHP/inicio_sesion.php",
        data:{
            id_usuario : usuario,
            contra : contra
        },
        type: "POST",
        success: function(response){
            let n = response;
            //console.log(n);
            if (n.length == 2){
              jQuery.ajax({
                  url:"../../modelo/PHP/elimina_usuario.php",
                  data:{
                      usuario : autor
                  },
                  type: "POST",
                  success: function(response){
                      alert("El usuario ha sido eliminado mauajajaja");
                      }
                  });
              }
            else{
              alert("Ingrese bien los datos");
            }
        }
    });
});
