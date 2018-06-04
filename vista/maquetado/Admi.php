<html>
  <head>
    <title>Administrador</title>
    <?php include "head.html";?>
  </head>
  <body>
    <?php include "navbar.html";?>
    <button id='publicaciones' class="btn btn-outline-secondary" >Publicaciones</button>
    <button id='comentarios' class="btn btn-outline-secondary">Comentarios</button>
    <div id="contPublicaciones"></div>
    <div id="contComentarios"></div>
    <div class="modal fade" id="kk" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Inicio Sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php include "../../vista/maquetado/inicio_sesion.html"?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script src= "../../controlador/JS/nav_eventos.js" type="text/javascript"></script>
<script src= "../../controlador/JS/funciones_admi.js" type="text/javascript"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
