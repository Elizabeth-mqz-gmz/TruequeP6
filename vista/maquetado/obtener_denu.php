<script type='text/javascript' src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' integrity='sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB' crossorigin='anonymous'>
<!-- <script type= 'text/javascript' src='../../controlador/JS/calendario.js'></script> -->
<script type='text/javascript' src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
<meta charset='UTF-8' />
  <body>
    <button id='publicaciones' >Publicaciones</button>
    <button id='comentarios'>Comentarios</button>
    <div id="contPublicaciones"></div>
    <div id="contComentarios"></div>
    <div class="modal fade" id="Eliminar" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Por favor ingresa los datos para confirmar que eres administrador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php include "inicio_sesion.html"?>
          </div>
        </div>
      </div>
    </div>
    </body>
<script>
$("#publicaciones").on("click", function(){
  $(".quitar").remove();
  denuncia("1", "Publicaciones");
});

$("#comentarios").on("click", function(){
  $(".quitar").remove();
  denuncia("2","Comentarios");
});

function mostrar_publid(respuesta, donde){
  for (let i in respuesta ){
    let autor = $("<div class='quitar'>"+respuesta[i].id_autor+"</div><button autor ='"+respuesta[i].id_autor+"'publi='"+respuesta[i].id_publicacion+"' class='quitar' value = 'quitarD'>Quitar Denuncia</button><button autor ='"+respuesta[i].id_autor+"'publi='"+respuesta[i].id_publicacion+"' class='quitar' value = 'eliminarD'>Eliminar Publicación</button>");
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
            mostrar_publid(JSON.parse(response), donde);
            console.log(response);
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

</script>
