<html>
  <head>
    <title>Administrador</title>
    <?php include "head.html";?>
    <link rel="stylesheet" href="../estilo/administrador.css" />
  </head>
  <body>
    <?php include "navbar.php";?>
    <div class="container">
      <div class="row">
        <div class="col"><button id='publicaciones' class="btn  btn-lg btn-block" >Publicaciones</button></div>
        <div class="col"><button id='comentarios' class="btn  btn-lg btn-block">Comentarios</button></div>
        <div class="col"><button data-target='#notificacionesPT'data-toggle='modal' class="btn btn-lg btn-block">Notificación</button></div>
      </div>
    </div>
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
            <?php include "../../vista/maquetado/inicio_sesion.html";?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="notificacionesPT" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header headerForm">
            <h5 class="modal-title">Notificación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formSuperNoti">
              <div class="form-group formtexto">
                <label >Mensaje</label>
                <input type="text" class="form-control" id="menNotif" placeholder="Hola...">
              </div>
              <button type="reset" class="btn btn-dark" id="NotificacionesTodos">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include "modal.html";; ?>
  </body>
</html>
<script src= "../../controlador/JS/nav_eventos.js" type="text/javascript"></script>
<script src= "../../controlador/JS/administrador.js" type="text/javascript"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
