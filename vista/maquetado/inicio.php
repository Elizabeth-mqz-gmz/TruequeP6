<html>
  <head>
    <title>Inicio</title>
    <?php include "head.html" ?>
    <link rel="stylesheet" href="../estilo/inicio.css">
  </head>
  <body>
    <div id="contenedor">
      <div class="botones">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Registro" >Registro</button>
      </div>
      <div class="botones">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Inicio_Sesion">Inicio de Sesión</button>
      </div>
    </div>
    <div class="modal fade" id="Registro" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php include "regis.html"?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="Inicio_Sesion" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Inicio Sesión</h5>
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
</html>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
