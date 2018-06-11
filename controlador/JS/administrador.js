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

function obtener_inf (mensaje1, mensaje2, tabla, div){//obtener elementos necesarios para poder ejecutar otras funciones
  let denun = event.target.value;
  let publi = event.target.getAttribute("publi");
  autor = event.target.getAttribute("autor");
  let perfil = event.target.getAttribute("perfil");
  if (denun == "quitarD"){
    quitar_eliminar("quitar_denuncia", autor, publi, mensaje1, tabla, div);
  }
  else if (denun == "eliminarD"){
    quitar_eliminar("eliminar_publicacion", autor, publi, mensaje2, tabla, div);
  }
  else if(denun == "usuario"){
    $("#kk").modal("show");
  }
  if (perfil == "si" ){//Enviarte al perfil del usuario
    document.cookie = "usuBuscado="+autor+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere
    location.href ="perfil_usuario.php";
  }
}

function desplegarPublicacion(respuesta){
  //objeto que contiene todo relacionado con la publicacion
  let imagen = respuesta.imagen_publi.replace("..","")
  respuesta.imagen_publi = imagen;
  let  datos = $("<div class ='quitar'><div class='card quitar' style='width: 45%;' ><div class='card-header PerfilDenun' perfil='si' autor ='"+respuesta.id_autor+"'><h4 perfil='si' autor ='"+respuesta.id_autor+"' style='color:#FBF8F7;'>"+respuesta.id_autor+"</h4></div><div class='card-body'><img class='card-img-top' src='../../modelo/"+respuesta.imagen_publi+"' class='quitar'/><p class='quitar card-text'>"+respuesta.publicacion+"</p><h6 class='card-title'>"+respuesta.razon_denuncia+"</h6><div class='text-right'><button class='btn quitar-denuncia' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn eliminar-publicacion' autor ='"+respuesta.id_autor+"'publi='"+respuesta.id_publicacion+"' value = 'eliminarD'>Eliminar Publicación</button><button class='btn elimina-usuario' value = 'usuario' class='btn btn-danger' autor ='"+respuesta.id_autor+"'>Eliminar Usuario</button></div></div></div></div>");
  datos.appendTo("#contPublicaciones");
}

function desplegarComentario(respuesta){//mostrar los comentario
  let datos = $("<div class ='quitar'><div class='card quitar' style='width: 45%;'><div class='card-header PerfilDenun' perfil='si' autor ='"+respuesta.id_autor+"'><h4 perfil='si' autor ='"+respuesta.id_autor+"' style='color:#FBF8F7;'>"+respuesta.id_usu_comen+"</h4></div><div class='card-body'><p class='card-text'>"+respuesta.comentario+"</p><div class='text-right'><button class='btn eliminar-denuncia'autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'quitarD'>Quitar Denuncia</button><button class='btn eliminar-publicacion' autor ='"+respuesta.id_usu_comen+"'publi='"+respuesta.id_comen+"' value = 'eliminarD'>Eliminar Comentario</button><button data-target='#kk'data-toggle='modal' value = 'usuario' class='btn eliminar-usuario' autor ='"+respuesta.id_autor+"'>Eliminar Usuario</button></div></div></div></div>");
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
          ModalGlobal("Éxito","¡Proceso Éxitoso!, la "+mensaje+" ha sido eliminada");
          $(".quitar").remove();
          denuncia(valor, div);
      }
  });
}

var autor = "Wuuu";
document.getElementById("contPublicaciones").addEventListener("click",()=>{
  obtener_inf("denuncia", "publicación", "1", "Publicaciones");
});

document.getElementById("contComentarios").addEventListener("click",()=>{
  obtener_inf("denuncia", "comentario", "2", "Comentarios");
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
            console.log(autor);
            if (n.length == 2){
              jQuery.ajax({
                  url:"../../modelo/PHP/elimina_usuario.php",
                  data:{
                      usuario : autor
                  },
                  type: "POST",
                  success: function(response){
                      // console.log(response);
                      document.getElementById("formIS").reset();
                      $("#kk").modal("hide");//dejar de mostrar el formulario
                      if (response == "")
                        ModalGlobal("Éxito","El usuario ha sido eliminado");
                      else
                        ModalGlobal("Cuidado","No es posible eliminar al administrador");
                      window.location.href="Admi.php";//enviarte
                      }
                  });
              }
            else{
              ModalGlobal("Datos incorrectos","Ingrese bien los datos");
            }
        }
    });
});

$("#NotificacionesTodos").on("click", function(){
  let mensaje = $("#menNotif").val();
  console.log(mensaje);
  if (mensaje != ""){
    jQuery.ajax({
      url:"../../modelo/PHP/Notificaciones_Todos.php",
      data:{
          notificacion : mensaje
      },
      type: "POST",
      success: function(response){
          $('#notificacionesPT').modal('hide');
          ModalGlobal("Éxito","El mensaje <i>"+mensaje+"</i> ha sido enviado.");
          }
      });
    }
  else{
    $('#notificacionesPT').modal('hide');
    ModalGlobal("Dato incorrecto","Por favor ingrese un mensaje");
  }
});
